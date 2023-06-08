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
        $time_select = [];
        $filters = [];
        $idOrder = null;
        $infoOrder = null;
        $time = now()->setTimezone('Asia/Ho_Chi_Minh');
        $date = Carbon::parse($time);
        $year = $date->year;
        $month = $date->month;
        $time_select[] = ['orders.updated_at', '=',  $year];
        $time_select[] = ['orders.updated_at', '=',  $month];
        $customerView = $employeerView = $create_atView = $idOrderView = $statusView = $totalView = $phone = $address = $note = null;
        if (!empty($request->time_select)) {
            [$year, $month] = explode("-", $request->time_select);
            $time_select = [];
            $time_select[] = ['orders.updated_at', '=',  intval($year)];
            $time_select[] = ['orders.updated_at', '=', intval($month)];
        }
        if (!empty($request->unconfimred) && $request->unconfimred == "true") {
            $filters[] = ['orders.status', '=', "XN"];
        }
        if (!empty($request->received) && $request->received == "true") {
            $filters[] = ['orders.status', '=', "TC"];
        }
        if (!empty($request->shipping) && $request->shipping == "true") {
            $filters[] = ['orders.status', '=', "DVC"];
        }
        if (!empty($request->fail) && $request->fail == "true") {
            $filters[] = ['orders.status', '=', "TB"];
        }
        if (!empty($request->customer)) {
            $time_select = [];
            $idOrder = $request->customer;
            $infoOrder = DB::table('orders')
                ->join('users', 'users.id', '=', 'orders.customers')
                ->join('administrator', 'administrator.id', '=', 'orders.employee')
                ->where('orders.id', $idOrder)
                ->select(
                    'orders.*',
                    'users.name as user_name',
                    'users.phone_number as phone_number',
                    'users.address as user_address',
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
                'phone' => $infoOrder->phone_number,
                'address' => $infoOrder->user_address,
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
        $orders = $this->orders->getAllOrder($filters, $time_select, $idOrder);
        $details = $this->orders->getAllOrderDetail($filters, $time_select, $idOrder);
        return view('admin.order.index', compact('title', 'orders', 'details', 'unconfirmed', 'received', 'fail', 'revenue', 'shipping', 'year', 'month', 'time', 'customerView', 'employeerView', 'create_atView', 'idOrderView', 'statusView', 'totalView', 'phone', 'address', 'note'));
    }
    public function updateStatus(Request $request, $id)
    {
        $status = null;
        switch ($request->statusOrder) {
            case "TC":
                $status = auth()->guard("admin")->user()->id . " status: Thành công - " . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');
                break;
            case "XN":
                $status = auth()->guard("admin")->user()->id . " status: Chưa xác nhận - " . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');
                break;
            case "TB":
                $status = auth()->guard("admin")->user()->id . " status: Thất bại - " . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');
                break;
            case "DVC":
                $status = auth()->guard("admin")->user()->id . " status: Đang vận chuyển - " . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y');
                break;
        }
        $statusOld = Order::where('id', $id)->first();
        DB::table('orders')->where('id', $id)
            ->update(
                [
                    'status' => $request->statusOrder,
                    'employee' => auth()->guard("admin")->user()->id,
                    'updated_at' => now()->setTimezone('Asia/Ho_Chi_Minh'),
                    'note' => $status . ", " . $statusOld->note
                ]
            );
        if ($request->statusOrder == "TC") {
            $details = Order::join('order_details', 'orders.id', '=', 'order_details.orders')
                ->select([
                    'order_details.product as idProduct',
                    'order_details.quantity as quantity',
                ])
                ->where('orders.id', $id)->get();;
            foreach ($details as $detail) {
                Product::where('id', $detail->idProduct)->decrement('quantity', $detail->quantity);
            }
        }
        return response()->json([
            'status' => 200,
            'msg' => "Update status successfully",
        ]);
    }
}
