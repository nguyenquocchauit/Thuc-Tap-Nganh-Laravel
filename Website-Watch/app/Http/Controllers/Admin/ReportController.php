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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Báo cáo';
        $search = [];

        $product = new Order();
        $time = $product->currentTime();
        $date = Carbon::parse($time);
        $year = $date->year;
        $month = $date->month;
        if (!empty($request->time_select)) {
            $search = explode("-", $request->time_select);
            $year = $search[0];
            $month = $search[1];
            $search[0] = ['orders.updated_at', '=',  $year];
            $search[1] = ['orders.updated_at', '=',  $month];
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


        $orders = $this->orders->getAllOrder($search);
        return view('admin.reporting.index', compact('title', 'orders', 'shipping', 'received', 'time', 'year', 'month', 'newbie', 'revenue'));
    }
}
