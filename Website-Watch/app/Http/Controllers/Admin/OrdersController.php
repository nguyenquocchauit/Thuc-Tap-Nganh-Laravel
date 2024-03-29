<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    private $orders;
    public function __construct()
    {
        $this->orders = new Order();
    }
    public function index(Request $request)
    {
        $title = 'Đơn hàng';
        $filters = [];
        $idOrder = null;
        $infoOrder = null;
        $time = now()->setTimezone('Asia/Ho_Chi_Minh');
        $date = Carbon::parse($time);
        $year = $date->year;
        $month = $date->month;
        $customerView = $employeerView = $create_atView = $idOrderView = $statusView = $totalView = $phone = $delivery_address = $status_payment = $order_notes = $note = null;
        $start_day = now()->startOfMonth()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d 00:00:00');
        $end_day = now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        if (!empty($request->start_day)) {
            $start_day = date('Y-m-d H:i:s', strtotime($request->start_day));
        }
        if (!empty($request->end_day)) {
            $end_day = date('Y-m-d', strtotime($request->end_day));
            $end_day .= '23:59:59';
        }
        $statuses = [
            'unconfimred' => 'XN',
            'received' => 'TC',
            'shipping' => 'DVC',
            'fail' => 'TB'
        ];

        foreach ($statuses as $key => $value) {
            if (!empty($request->$key) && $request->$key == "true") {
                $filters[] = ['orders.status', '=', $value];
            }
        }
        if (!empty($request->customer)) {
            $start_day = null;
            $end_day = null;
            $idOrder = $request->customer;
            $infoOrder = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.customers')
                ->join('administrator', 'administrator.id', '=', 'orders.employee')
                ->where('orders.id', $idOrder)
                ->select(
                    'orders.*',
                    'users.name as user_name',
                    'users.phone_number as phone_number',
                    'administrator.name as admin_name',
                    DB::raw("DATE_FORMAT(orders.created_at,'%H:%i:%s %d-%m-%Y') as created_at")
                )
                ->first();
            extract([
                'customerView' => $infoOrder->user_name,
                'employeerView' => $infoOrder->admin_name,
                'create_atView' => $infoOrder->created_at,
                'idOrderView' => $infoOrder->id,
                'statusView' => $infoOrder->status,
                'totalView' => $infoOrder->total,
                'order_notes' => $infoOrder->order_notes,
                'status_payment' => $infoOrder->status_payment,
                'phone' => $infoOrder->phone_number,
                'delivery_address' => $infoOrder->delivery_address,
                'note' => $infoOrder->note
            ]);
        }
        if (!empty($request->search)) {
            $idOrder = $request->search;
        }



        $shipping = Order::where('status', 'DVC')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->count();
        $received = Order::where('status', 'TC')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->count();
        $revenue = Order::where('status', 'TC')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->sum('total');
        $unconfirmed = Order::where('status', 'XN')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->count();

        $fail = Order::where('status', 'TB')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->count();
        $orders = $this->orders->getAllOrder($filters, $start_day, $end_day, $idOrder);
        $details = $this->orders->getAllOrderDetail($filters,  $start_day, $end_day, $idOrder);
        return view('admin.order.index', compact('title', 'orders', 'details', 'unconfirmed', 'received', 'fail', 'revenue', 'shipping', 'year', 'month', 'time', 'customerView', 'employeerView', 'create_atView', 'idOrderView', 'statusView', 'totalView', 'phone', 'delivery_address', 'note', 'order_notes', 'status_payment'));
    }
    public function updateStatus(Request $request, $id)
    {
        $status_payment = 0;
        $status = auth()->guard("admin")->user()->id . " status: ";
        switch ($request->statusOrder) {
            case "TC":
                $status .= "Thành công";
                break;
            case "XN":
                $status .= "Chưa xác nhận";
                break;
            case "TB":
                $status .= "Thất bại";
                break;
            case "DVC":
                $status .= "Đang vận chuyển";
                break;
        }
        $status .= " - " . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');
        $statusOld = Order::where('id', $id)->first();
        if ($request->statusOrder == "TC")
            $status_payment = 1;
        DB::table('orders')->where('id', $id)
            ->update(
                [
                    'status' => $request->statusOrder,
                    'employee' => auth()->guard("admin")->user()->id,
                    'updated_at' => now()->setTimezone('Asia/Ho_Chi_Minh'),
                    'note' => $status . ", " . $statusOld->note,
                    'status_payment' => $status_payment,
                ]
            );
        $details = Order::join('order_details', 'orders.id', '=', 'order_details.orders')
            ->select([
                'order_details.product as idProduct',
                'order_details.quantity as quantity',
                'orders.status as status',
            ])
            ->where('orders.id', $id)->get();
        if ($request->statusOrder == "TC" && $request->statusOrder !=  $statusOld->status) {
            foreach ($details as $detail) {
                Product::where('id', $detail->idProduct)->decrement('quantity', $detail->quantity);
            }
        }
        if ($request->statusOrder == "TB" &&   $statusOld->status == "TC") {
            foreach ($details as $detail) {
                Product::where('id', $detail->idProduct)->increment('quantity', $detail->quantity);
            }
        }

        return response()->json([
            'status' => 200,
            'msg' => "Update status successfully",
        ]);
    }
}
