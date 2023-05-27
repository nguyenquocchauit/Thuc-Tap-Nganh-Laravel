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
        $search = [];
        $filters = [];
        $times =[];
        $time = now()->setTimezone('Asia/Ho_Chi_Minh');
        $date = Carbon::parse($time);
        $year = $date->year;
        $month = $date->month;
        $times[0] =  $year;
        $times[1] =  $month;
        if (!empty($request->time_select)) {
            $search = explode("-", $request->time_select);
            $year = $search[0];
            $month = $search[1];
            $search[0] = ['orders.updated_at', '=',  $year];
            $search[1] = ['orders.updated_at', '=',  $month];
        }
        if (!empty($request->unconfimred && $request->unconfimred == "true")) {
            $filters[] = ['orders.status', '=', "XN"];
        }
        if (!empty($request->received && $request->received == "true")) {
            $filters[] = ['orders.status', '=', "TC"];
        }
        if (!empty($request->shipping && $request->shipping == "true")) {
            $filters[] = ['orders.status', '=', "DVC"];
        }
        if (!empty($request->fail && $request->fail == "true")) {
            $filters[] = ['orders.status', '=', "TB"];
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

        $orders = $this->orders->getAllOrder($filters, $search);
        $customers = new ModelsUser();
        $customers = $customers->getAllUsers($filters,$times );
        return view('admin.reporting.index', compact('title', 'orders','customers', 'fail', 'shipping', 'received', 'time', 'year', 'month', 'newbie', 'revenue', 'unconfimred'));
    }
}
