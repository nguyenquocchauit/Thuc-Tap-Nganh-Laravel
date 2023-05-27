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
    public function getAllOrder($filters = [], $search = [], $id = null)
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
        if (!empty($search)) {
            /*
            $search[1][0]: updated_at
            $search[1][1]: =
            $search[1][2]: month( is number )
             */
            $orders = $orders->whereYear($search[0][0], $search[0][1], $search[0][2]);
            $orders = $orders->whereMonth($search[1][0], $search[1][1], $search[1][2]);
        }
        $orders = $orders->paginate(10);
        return $orders;
    }
    public function getAllOrderDetail($filters = [], $search = [], $id = null)
    {
        $details = Order::join('order_details', 'orders.id', '=', 'order_details.orders')
            ->join('users', 'orders.customers', '=', 'users.id')
            ->join('administrator', 'orders.employee', '=', 'administrator.id')
            ->join('products', 'order_details.product', '=', 'products.id')
            ->join('images', 'images.id', '=', 'products.image')
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
                'images.image_1 as image',
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

        if (!empty($search)) {
            /*
            $search[1][0]: updated_at
            $search[1][1]: =
            $search[1][2]: month( is number )
             */
            $details->whereYear($search[0][0], $search[0][1], $search[0][2]);
            $details->whereMonth($search[1][0], $search[1][1], $search[1][2]);
        }
        $details = $details->paginate(10);
        return $details;
    }
}
