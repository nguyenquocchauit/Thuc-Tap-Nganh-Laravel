<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyProductController extends Controller
{
    //
    public function viewBuy(Request $request)
    {
        $cart = session()->get('cart'); // Lấy thông tin giỏ hàng từ session.
        if (isset($cart)) {
            $title = 'Thanh toán';
            $time = now()->setTimezone('Asia/Ho_Chi_Minh');
            return view('product.viewbuy', compact('title', 'time'));
        }
        return redirect('/shop');
    }
    public function checkout($data)
    {
        if (isset($data->method) && $data->method == "bank") {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/thanks";
            $vnp_TmnCode = "UDXG85I4"; //Mã website tại VNPAY
            $vnp_HashSecret = "BSJJGNZGFZPHUFRYPPNUWVEXVYPLLQFZ"; //Chuỗi bí mật

            $vnp_TxnRef = $data->idorder; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "Thanh toán ATM";
            $vnp_OrderType = $data->method;
            $vnp_Amount =  $data->amount * 100;
            $vnp_Locale = "vn";
            $vnp_BankCode = "NCB";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = $_POST['txtexpire'];
            // // Invoice
            $user = User::where("id", $data->customer)->first();
            $vnp_Inv_Phone = $user->phone_number;
            $vnp_Inv_Email = $user->email;
            $vnp_Inv_Customer = $user->name;
            $vnp_Inv_Address = $data->delivery_address;
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_Inv_Phone" => $vnp_Inv_Phone,
                "vnp_Inv_Email" => $vnp_Inv_Email,
                "vnp_Inv_Customer" => $vnp_Inv_Customer,
                "vnp_Inv_Address" => $vnp_Inv_Address,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($data->method)) {
                return $vnp_Url;
            } else {
                echo json_encode($returnData);
            }
        }
    }
    public function Order(Request $request)
    {

        $total = 0; // Khởi tạo biến $total.
        $user = User::find($request->user); // Tìm kiếm thông tin người dùng.
        $detail = $quantityProduct = array(); // Khởi tạo hai mảng rỗng.
        if ($user) { // Kiểm tra xem người dùng có tồn tại hay không.
            if ($user->address) { // Kiểm tra xem người dùng đã cập nhật địa chỉ giao hàng hay chưa.
                if ($request->action == "Order") { // Kiểm tra xem hành động được yêu cầu là mua sản phẩm từ giỏ hàng hay không.
                    $cart = session()->get('cart'); // Lấy thông tin giỏ hàng từ session.
                    if (isset($cart)) {
                        // lấy tổng giá của giỏ hàng khi chèn thứ tự bảng và giá trị cho chi tiết thứ tự bảng chèn
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
                            'method_payment' => $request->method,
                            'status_payment' => '0',
                            'delivery_address' => $request->address,
                            'order_notes' => $request->order_notes,
                        ]);
                        // thêm data vào bảng order_detail
                        OrderDetail::insert($detail);
                        $request->session()->forget('cart');
                        $data_checkout = (object) array(
                            "method" => $request->method,
                            "idorder" => $IDOrder,
                            "customer" => $request->user,
                            "delivery_address" => $request->address,
                            "amount" => $total + ($total * 0.08),
                        );
                        if ($request->method == "bank")
                            return response()->json([
                                'msg'=> 'bank',
                                'url' => $this->checkout($data_checkout),
                            ]);
                        if ($request->method == "cash") {
                            return response()->json([
                                'status' => 200,
                                'msg'=> 'cash payment',
                            ]);
                        }
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
    public function Payment(Request $request)
    {
        /* Payment Notify
        * IPN URL: Ghi nhận kết quả thanh toán từ VNPAY
        * Các bước thực hiện:
        * Kiểm tra checksum
        * Tìm giao dịch trong database
        * Kiểm tra số tiền giữa hai hệ thống
        * Kiểm tra tình trạng của giao dịch trước khi cập nhật
        * Cập nhật kết quả vào Database
        * Trả kết quả ghi nhận lại cho VNPAY
        */
        $inputData = array();
        $returnData = array();
        $vnp_HashSecret = "BSJJGNZGFZPHUFRYPPNUWVEXVYPLLQFZ"; //Chuỗi bí mật
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi

        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch


                $order = Order::where("id", $orderId)->first();
                if ($order != NULL) {
                    if ($order->total == $vnp_Amount) //Kiểm tra số tiền thanh toán của giao dịch: giả sử số tiền kiểm tra là đúng. //$order->total == $vnp_Amount
                    {
                        if ($order->status_payment == 0) {
                            if ($inputData['vnp_ResponseCode'] == '00' || $inputData['vnp_TransactionStatus'] == '00') {
                                $Status = 1; // Trạng thái thanh toán thành công
                            } else {
                                $Status = 2; // Trạng thái thanh toán thất bại / lỗi
                            }
                            //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                            DB::table('orders')->where('id', $orderId)->update([
                                "status_payment" =>  $Status,
                            ]);
                            //Trả kết quả về cho VNPAY: Website/APP TMĐT ghi nhận yêu cầu thành công
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON
        return view('product.thanks', compact('Status'));
    }
}
