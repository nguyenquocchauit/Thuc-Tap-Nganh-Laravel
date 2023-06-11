<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    private $orders;
    public function __construct()
    {
        $this->orders = new Order();
    }
    public function reportRevenue(Request $request)
    {
        $title = 'Báo cáo';
        $filters = [];
        $search = null;

        $time = now()->setTimezone('Asia/Ho_Chi_Minh');
        $date = Carbon::parse($time);
        $year = $date->year;
        $start_day = now()->startOfMonth()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d 00:00:00');
        $end_day = now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        if (!empty($request->start_day)) {
            $start_day = date('Y-m-d H:i:s', strtotime($request->start_day));
        }
        if (!empty($request->end_day)) {
            $end_day = date('Y-m-d', strtotime($request->end_day));
            $end_day .= ' 23:59:59';
        }
        if (!empty($request->search)) {
            $search = $request->search;
        }
        $received = Order::where('status', 'TC')
            ->whereBetween('updated_at', [$start_day, $end_day])
            ->count();
        $revenue = Order::where('status', 'TC')
            ->whereBetween('updated_at', [$start_day, $end_day])
            ->sum('total');
        $fail = Order::where('status', 'TB')
            ->whereBetween('updated_at', [$start_day, $end_day])
            ->count();
        $totalOrder = Order::whereBetween('updated_at', [$start_day, $end_day])
            ->count();
        $revenueBrands = $this->orders->revenueBrand($start_day, $end_day, $search);

        return view('admin.reporting.revenue', compact('title', 'revenueBrands', 'totalOrder', 'revenue', 'received', 'fail','year'));
    }
    public function reportOrder(Request $request)
    {
        $title = 'Thống kê đơn hàng';
        $search = [];
        $filters = [];
        $start_day = now()->startOfMonth()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d 00:00:00');
        $end_day = now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        if (!empty($request->start_day)) {
            $start_day = date('Y-m-d H:i:s', strtotime($request->start_day));
        }
        if (!empty($request->end_day)) {
            $end_day = date('Y-m-d', strtotime($request->end_day));
            $end_day .= ' 23:59:59';
        }
        if (!empty($request->search)) {
            $search = $request->search;
        }
        if (!empty($request->unconfirmed) && $request->unconfirmed == "true") {
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
        $shipping = Order::where('status', 'DVC')
            ->whereBetween('updated_at', [$start_day, $end_day])
            ->count();
        $received = Order::where('status', 'TC')
            ->whereBetween('updated_at', [$start_day, $end_day])
            ->count();
        $revenue = Order::where('status', 'TC')
            ->whereBetween('updated_at', [$start_day, $end_day])
            ->sum('total');
        $unconfirmed = Order::where('status', 'XN')
            ->whereBetween('updated_at', [$start_day, $end_day])
            ->count();
        $fail = Order::where('status', 'TB')
            ->whereBetween('updated_at', [$start_day, $end_day])
            ->count();
        $orders = $this->orders->getAllOrder($filters, $start_day, $end_day, $search);
        return view('admin.reporting.order', compact('title', 'orders', 'shipping', 'received', 'revenue', 'unconfirmed', 'fail'));
    }
    public function reportCustomer(Request $request)
    {
        $title = 'Thống kê khách hàng';
        $search = [];
        $start_day = now()->startOfMonth()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d 00:00:00');
        $end_day = now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        if (!empty($request->start_day)) {
            $start_day = date('Y-m-d H:i:s', strtotime($request->start_day));
        }
        if (!empty($request->end_day)) {
            $end_day = date('Y-m-d', strtotime($request->end_day));
            $end_day .= ' 23:59:59';
        }
        if (!empty($request->search)) {
            $search = $request->search;
        }
        $customers = new ModelsUser();
        $customers = $customers->getAllUsers($search, $start_day, $end_day);
        return view('admin.reporting.customer', compact('title', 'customers'));
    }
    public function dataChart(Request $request)
    {
        $year = $month = null;
        $time = now()->setTimezone('Asia/Ho_Chi_Minh');
        $date = Carbon::parse($time);
        $year = $date->year;
        if (!empty($request->time)) {
            [$year, $month] = explode("-", $request->time);
        }

        $value = Order::join('order_details', 'orders.id', '=', 'order_details.orders')
            ->join('products', 'order_details.product', '=', 'products.id')
            ->join('brands', 'products.brand', '=', 'brands.id')
            ->select([
                'brands.name as name_brand',
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 1 THEN order_details.quantity ELSE 0 END) AS "thang_1"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 2 THEN order_details.quantity  ELSE 0  END) AS "thang_2"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 3 THEN order_details.quantity ELSE 0 END) AS "thang_3"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 4 THEN order_details.quantity ELSE 0  END) AS "thang_4"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 5 THEN order_details.quantity  ELSE 0 END) AS "thang_5"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 6 THEN order_details.quantity  ELSE 0  END) AS "thang_6"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 7 THEN order_details.quantity  ELSE 0  END) AS "thang_7"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 8 THEN order_details.quantity  ELSE 0  END) AS "thang_8"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 9 THEN order_details.quantity  ELSE 0  END) AS "thang_9"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 10 THEN order_details.quantity  ELSE 0  END) AS "thang_10"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 11 THEN order_details.quantity  ELSE 0  END) AS "thang_11"'),
                DB::raw('SUM(CASE WHEN MONTH(orders.updated_at) = 12 THEN order_details.quantity  ELSE 0  END) AS "thang_12"')
            ])
            ->whereYear('orders.updated_at', $year)
            ->where('orders.status', '=', 'TC')
            ->groupBy('brands.name')->get();

        return response()->json([
            'status' => 200,
            'msg' => 'Get data successfully',
            'data' => $value,
        ]);
    }
}
