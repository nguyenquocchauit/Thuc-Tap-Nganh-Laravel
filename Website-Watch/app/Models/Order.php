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
    public function getAllOrder($search = [])
    {
        $orders = Order::join('order_details', 'orders.id', '=', 'order_details.orders')
            ->join('users', 'orders.customers', '=', 'users.id')
            ->join('administrator', 'orders.employee', '=', 'administrator.id')
            ->join('products', 'order_details.product', '=', 'products.id')
            ->join('images', 'images.id', '=', 'products.image')
            ->select([
                'order_details.id as idDetail',
                'orders.status as status',
                'users.name as name_customer',
                'administrator.name as name_employee',
                'products.id as idProduct',
                'images.image_1 as image',
                DB::raw("DATE_FORMAT(order_details.created_at,'%H:%i:%s %d-%m-%Y') as created_at")
            ])
            ->orderBy('orders.created_at', 'desc');
        if (!empty($search)) {
            /*
            $search[1][0]: updated_at
            $search[1][1]: =
            $search[1][2]: month( is number )
             */
            $orders->whereYear($search[0][0], $search[0][1], $search[0][2]);
            $orders->whereMonth($search[1][0], $search[1][1], $search[1][2]);
        }
        $orders = $orders->paginate(10);
        return $orders;
    }
}
