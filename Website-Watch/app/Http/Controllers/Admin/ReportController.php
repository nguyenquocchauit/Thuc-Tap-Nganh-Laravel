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
    public function index(Request $request)
    {
        $title = 'Báo cáo';
        $time_select = [];
        $filters = [];
        $search = [];
        $times = [];
        $time = now()->setTimezone('Asia/Ho_Chi_Minh');
        $date = Carbon::parse($time);
        $year = $date->year;
        $month = $date->month;
        $times[0] =  $year;
        $times[1] =  $month;
        if (!empty($request->time_select)) {
            $time_select = explode("-", $request->time_select);
            $year = $time_select[0];
            $month = $time_select[1];
            $time_select[0] = ['orders.created_at', '=',  $year];
            $time_select[1] = ['orders.created_at', '=',  $month];
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
        if (!empty($request->search)) {
            $search = $request->search;
        }
        $shipping = Order::where('status', 'DVC')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->count();
        $received = Order::where('status', 'TC')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->count();
        $newbie = ModelsUser::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->count();
        $revenue = Order::where('status', 'TC')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->sum('total');
        $unconfimred = Order::where('status', 'XN')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->count();
        $fail = Order::where('status', 'TB')
            ->whereYear('updated_at', '=', $year)
            ->whereMonth('updated_at', '=', $month)
            ->count();

        $orders = $this->orders->getAllOrder($filters, $time_select, $search);
        $customers = new ModelsUser();
        $customers = $customers->getAllUsers($search, $times);
        $revenueBrands = $this->orders->revenueBrand($filters, $time_select, $search);
        return view('admin.reporting.index', compact('title', 'orders', 'customers', 'revenueBrands', 'fail', 'shipping', 'received', 'time', 'year', 'month', 'newbie', 'revenue', 'unconfimred'));
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
            'status'=>200,
            'msg'=>'Get data successfully',
            'data' =>$value,
        ]);
    }
}
