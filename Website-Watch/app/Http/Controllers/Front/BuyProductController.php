<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyProductController extends Controller
{
    //
    public function buyProductCart(Request $request)
    {

        $total = 0; // Khởi tạo biến $total.
        $user = User::find($request->user); // Tìm kiếm thông tin người dùng.
        $detail = $quantityProduct = array(); // Khởi tạo hai mảng rỗng.
        if ($user) { // Kiểm tra xem người dùng có tồn tại hay không.
            if ($user->address) { // Kiểm tra xem người dùng đã cập nhật địa chỉ giao hàng hay chưa.
                if ($request->action == "Buy product from cart") { // Kiểm tra xem hành động được yêu cầu là mua sản phẩm từ giỏ hàng hay không.
                    $cart = session()->get('cart'); // Lấy thông tin giỏ hàng từ session.
                    if (isset($cart)) {
                        // get total price of cart for insert table order and value for insert table orderdetail
                        $IDOrder = "HD" . (Order::count() + 1) . now()->setTimezone('Asia/Ho_Chi_Minh')->format('HisdmY');
                        $count = OrderDetail::count();
                        foreach ($cart as $id => $product) {
                            $total += $cart[$id]['total'];
                            $count++;
                            array_push($detail, array(
                                "id" => "CTHD" . $count . now()->setTimezone('Asia/Ho_Chi_Minh')->format('HisdmY'),
                                "orders" => $IDOrder,
                                "product" => $id,
                                "quantity" => $cart[$id]['quantity'],
                                "price" => $cart[$id]['price'],
                                "discount" => $cart[$id]['discount'],
                                "total" => ($cart[$id]['priceDiscount'] * $cart[$id]['quantity']) + (($cart[$id]['priceDiscount'] * $cart[$id]['quantity']) * 0.08),
                            ));
                            $quantity = Product::where('id', $id)->first();
                            array_push($quantityProduct, array(
                                "id" => $id,
                                "quantity" => $quantity->quantity - $cart[$id]['quantity'],
                            ));
                        }
                        $order_date = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
                        $nv1_start = Carbon::createFromTime(7, 0, 0)->shiftTimezone('Asia/Ho_Chi_Minh');
                        $nv1_end = Carbon::createFromTime(11, 0, 0)->shiftTimezone('Asia/Ho_Chi_Minh');
                        $nv2_start = Carbon::createFromTime(11, 1, 0)->shiftTimezone('Asia/Ho_Chi_Minh');
                        $nv2_end = Carbon::createFromTime(17, 30, 0)->shiftTimezone('Asia/Ho_Chi_Minh');
                        $employeer = null;
                        if ($order_date->between($nv1_start, $nv1_end)) {
                            $employeer = "nv226052023";
                        } elseif ($order_date->between($nv2_start, $nv2_end)) {
                            $employeer = "nv323052023";
                        } else {
                            $employeer = "nv105122022";
                        }
                        // insert value to table order
                        DB::table('orders')->insert([
                            'id' => $IDOrder,
                            'customers' => $request->user,
                            'employee' =>  $employeer,
                            'status' => 'XN',
                            'created_at' =>  now()->setTimezone('Asia/Ho_Chi_Minh'),
                            'updated_at' => now()->setTimezone('Asia/Ho_Chi_Minh'),
                            'total' => $total + ($total * 0.08),
                            'note' => $employeer . " status: Chưa xác nhận - " . now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i:s d-m-Y'),
                        ]);
                        // thêm data vào bảng order_detail
                        OrderDetail::insert($detail);
                        // cập nhật số lượng sản phẩm
                        foreach ($quantityProduct as $item) {
                            $id = $item['id'];
                            $quantity = $item['quantity'];
                            Product::where('id', $id)->update(['quantity' => $quantity]);
                        }

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
