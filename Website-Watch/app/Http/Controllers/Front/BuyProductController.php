<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyProductController extends Controller
{
    //
    public function buyProductCart(Request $request)
    {

        $total = 0;
        $user = User::find($request->user);
        $orderDetail = new OrderDetail();
        $times = Carbon::createFromFormat('Y-m-d H:i:s', $orderDetail->currentTime());
        $times = $times->format('HisdmY');

        // get the total number of orders available in orders and order_details
        $countOrderDetails = DB::table('order_details')->count();
        $countOrders = DB::table('orders')->count();
        $IDOrder = "HD" . $countOrders . $times;
        $detail = array();
        if ($user) {
            if ($user->address) {
                if ($request->action == "Buy product from cart") {
                    $cart = session()->get('cart');
                    if (isset($cart)) {
                        // get total price of cart for insert table order and value for insert table orderdetail

                        foreach ($cart as $id => $product) {
                            $total += $cart[$id]['total'];
                            $countOrderDetails++;
                            array_push($detail, array(
                                "id" => "CTHD" . $countOrderDetails . $times,
                                "orders" => $IDOrder,
                                "product" => $id,
                                "quantity" => $cart[$id]['quantity'],
                                "price" => $cart[$id]['priceDiscount'],
                                "total" => ($cart[$id]['priceDiscount'] * $cart[$id]['quantity']) + ($cart[$id]['priceDiscount'] * $cart[$id]['quantity']) * 0.08,
                                "created_at" => $orderDetail->currentTime(),
                            ));
                        }
                        // // insert value to table order
                        DB::table('orders')->insert([
                            'id' => $IDOrder,
                            'customers' => $request->user,
                            'employee' => 1,
                            'status' => 'XN',
                            'created_at' =>  $orderDetail->currentTime(),
                            'updated_at' => $orderDetail->currentTime(),
                            'total' => $total + ($total * 0.08),
                        ]);
                        OrderDetail::insert($detail);
                        $request->session()->forget('cart');
                        return response()->json([
                            'status' => 200,
                            'msg' => 'Order successfully',
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status' => 500,
                    'msg' => 'User has not updated the address',
                ]);
            }
        } else {
            return response()->json([
                'status' => 500,
                'msg' => 'Not logged in user to the site',
            ]);
        }
    }
}
