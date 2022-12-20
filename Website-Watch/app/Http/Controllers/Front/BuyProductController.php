<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
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
        $order = new Order();
        // get ID automatic of table orders
        $IDOrder = $order->maxID();
        $IDOrder = $IDOrder[0]->ID_Max;
        $IDOrder += 1;
        // get ID automatic of table order_details
        $IDOrderDetail = $orderDetail->maxID();
        $IDOrderDetail = $IDOrderDetail[0]->ID_Max;
        $detail = array();
        if ($user) {
            if ($user->address) {
                if ($request->action == "Buy product from cart") {
                    $cart = session()->get('cart');
                    if (isset($cart)) {
                        // get total price of cart for insert table order and value for insert table orderdetail

                        foreach ($cart as $id => $product) {
                            $total += $cart[$id]['total'];
                            $IDOrderDetail++;
                            array_push($detail, array(
                                "id" => $IDOrderDetail,
                                "orders" => $IDOrder,
                                "product" => $id,
                                "quantity" => $cart[$id]['quantity'],
                                "price" => $cart[$id]['priceDiscount'] * $cart[$id]['quantity'],
                                "created_at" => $orderDetail->currentTime(),
                            ));

                        }
                        // insert value to table order
                        $order->id = $IDOrder;
                        $order->customers = $request->user;
                        $order->created_at = $order->currentTime();
                        $order->total = $total + ($total * 0.08);
                        $order->save();
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
