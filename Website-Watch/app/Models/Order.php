<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = false;
    protected $guarded = [];
    public $timestamps = false;

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'orders', 'id');
    }

    public function currentTime()
    {
        $currentTime = Carbon::now('Asia/Ho_Chi_Minh');
        return $currentTime->toDateTimeString();
    }
    public function getAllOrder($filters = [], $start_day = null, $end_day = null, $id = null)
    {
        $orders = Order::join('users', 'orders.customers', '=', 'users.id')
            ->join('administrator', 'orders.employee', '=', 'administrator.id')
            ->select([
                'orders.*',
                'orders.id as idOrder',
                'users.name as name_customer',
                'users.id as id_customer',
                'users.phone_number as phone',
                'administrator.name as name_employee',
                'administrator.id as id_employee',
                DB::raw("DATE_FORMAT(orders.created_at,'%H:%i:%s %d-%m-%Y') as created_at"),
                DB::raw("DATE_FORMAT(orders.updated_at,'%H:%i:%s %d-%m-%Y') as updated_at"),
            ])
            ->orderBy('orders.created_at', 'desc');
        if (!empty($id)) {
            $orders = $orders->where(function ($query) use ($id) {
                $query->orWhere('orders.id', $id);
            });
        }
        if (!empty($filters)) {
            $orders = $orders->where(function ($query) use ($filters) {
                foreach ($filters as $filter) {
                    $query->orWhere($filter[0], $filter[1], $filter[2]);
                }
            });
            $orders = $orders->where(function ($query) use ($id) {
                $query->orWhere('orders.employee', auth()->guard("admin")->user()->id);
            });
        }
        if (!empty($start_day) && !empty($end_day)) {
            $orders = $orders->whereBetween('orders.updated_at', [$start_day, $end_day]);
        }
        $orders = $orders->paginate(10);
        return $orders;
    }
    public function getAllOrderDetail($filters = [], $start_day = null, $end_day = null, $id = null)
    {
        $details = Order::join('order_details', 'orders.id', '=', 'order_details.orders')
            ->join('users', 'orders.customers', '=', 'users.id')
            ->join('administrator', 'orders.employee', '=', 'administrator.id')
            ->join('products', 'order_details.product', '=', 'products.id')
            ->select([
                'orders.id as idOrder',
                'orders.status as status',
                'users.name as name_customer',
                'users.id as id_customer',
                'users.phone_number as phone',
                'administrator.name as name_employee',
                'administrator.id as id_employee',
                'products.id as idProduct',
                'products.name as name_product',
                'products.image_1 as image_1',
                'order_details.id as idDetail',
                'order_details.price as detail_price',
                'order_details.discount as detail_discount',
                'order_details.total as detail_total',
                DB::raw("DATE_FORMAT(orders.created_at,'%H:%i:%s %d-%m-%Y') as created_at")
            ])
            ->orderBy('orders.created_at', 'desc');
        if (!empty($id)) {
            $details = $details->where(function ($query) use ($id) {
                $query->orWhere('orders.id', $id);
            });
        }
        if (!empty($filters)) {
            $details->where(function ($query) use ($filters) {
                foreach ($filters as $filter) {
                    $query->orWhere($filter[0], $filter[1], $filter[2]);
                }
            });
        }

        if (!empty($start_day) && !empty($end_day)) {
            $details = $details->whereBetween('orders.updated_at', [$start_day, $end_day]);
        }
        $details = $details->paginate(10);
        return $details;
    }
    public function revenueBrand($start_day = null, $end_day = null, $search = null)
    {
        $revenue = Order::join('order_details', 'orders.id', '=', 'order_details.orders')
            ->join('products', 'order_details.product', '=', 'products.id')
            ->join('brands', 'products.brand', '=', 'brands.id')
            ->select([
                'brands.name as name_brand',
                'products.gender as gender_brand',
                DB::raw('SUM(order_details.quantity) as quantity_brand'),
                DB::raw('SUM(CASE WHEN orders.status = "TC" THEN order_details.total ELSE 0 END) AS total_brand'),
                DB::raw('SUM(CASE WHEN orders.status = "TC" THEN 1 ELSE 0 END) AS TC'),
                DB::raw('SUM(CASE WHEN orders.status = "TB" THEN 1 ELSE 0 END) AS TB'),
            ])
            ->where("orders.status", "TC")
            ->groupBy('brands.name', 'products.gender')
            ->orderByDesc('brands.name'); // Sắp xếp giảm dần theo tên thương hiệu
        if (!empty($search)) {
            $revenue = $revenue->where(function ($query) use ($search) {
                $query->orWhere('brands.name', $search);
            });
        }
        if (!empty($start_day) && !empty($end_day)) {
            $revenue = $revenue->whereBetween('orders.updated_at', [$start_day, $end_day]);
        }

        $revenue = $revenue->paginate(10);
        return $revenue;
    }
}
