<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePasswordCustomerRequest;
use App\Http\Requests\UpdateProfileCustomerRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function profile()
    {
        return view('user.profile');
    }
    public function editCustomer($id)
    {
        $employee = User::select(
            DB::raw("*, DATE_FORMAT(created_at,'%H:%i:%s %d-%m-%Y') as create_at"),
            DB::raw("DATE_FORMAT(updated_at,'%H:%i:%s %d-%m-%Y') as update_at")
        )->find($id);
        $employeeAddress = explode(", ", $employee->address);
        $city = $employeeAddress[3] ?? "";
        $district = $employeeAddress[2] ?? "";
        $ward = $employeeAddress[1] ?? "";
        $address = $employeeAddress[0] ?? "";
        return response()->json([
            'status' => 200,
            'city' => $city,
            'district' => $district,
            'ward' => $ward,
            'address' => $address,
            'created_at' => $employee->create_at,
            'updated_at' => $employee->update_at,
        ]);
    }
    public function updateCustomer(UpdateProfileCustomerRequest $request, $id)
    {
        $now = now()->setTimezone('Asia/Ho_Chi_Minh');
        User::where('id', $id)->update($request->only(['name', 'phone_number', 'address', 'email']) + ['updated_at' => $now]);

        return response()->json([
            'status' => 200,
            'msg' => 'Update profile customer successfully',
        ]);
    }
    public function updatePassword(ProfilePasswordCustomerRequest $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->newPass);
        $user->updated_at = now()->setTimezone('Asia/Ho_Chi_Minh');
        $user->save();

        return response()->json([
            'status' => 200,
            'msg' => 'Update password successfully',
        ]);
    }
    public function orderHistory()
    {
        $orders = Order::join('users', 'orders.customers', '=', 'users.id')
            ->select([
                'orders.id as idOrder',
                'orders.status as status',
                'orders.total as total',
                DB::raw("DATE_FORMAT(orders.created_at,'%H:%i:%s %d-%m-%Y') as created_at")
            ])
            ->where("orders.customers", auth()->user()->id)
            ->orderBy('orders.created_at', 'desc')->get();
        return view('user.order_history', compact('orders'));
    }
    public function detailOrderHistory($id)
    {
        $orders = Order::where("orders.customers", auth()->user()->id)
            ->where("orders.id", $id)->get();
        $details = Order::join('order_details', 'order_details.orders', '=', 'orders.id')
            ->join('products', 'order_details.product', '=', 'products.id')
            ->join('users', 'orders.customers', '=', 'users.id')
            ->select([
                'products.id as product_id',
                'products.image_1 as image_1',
                'products.name as product_name',
                'order_details.quantity as detail_quantity',
                'order_details.total as detail_total',
                DB::raw(" (order_details.price - ( order_details.price* order_details.discount)/100) as detail_price")
            ])
            ->where("orders.customers", auth()->user()->id)
            ->where("orders.id", $id)
            ->orderBy('orders.created_at', 'desc')->get();
        return view('user.detail_order', compact('details', 'id', 'orders'));
    }
    public function cancelOrder($id)
    {
        $statusOld = Order::where('id', $id)->first();
        DB::table('orders')->where('id', $id)
            ->where("customers", auth()->user()->id)
            ->where("status", "XN")
            ->update(['status' => "TB", 'note' => "kh cancel - " . $statusOld->note,]);
        return response()->json([
            'status' => 200,
            'msg' => "Cancel order successfully",
        ]);
    }
}
