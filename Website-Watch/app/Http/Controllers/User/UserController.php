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
    public function purchaseHistory()
    {

        $orders = OrderDetail::query()
            ->selectRaw('products.*,order_details.created_at as bought, order_details.quantity as quantity,
            order_details.price as priceOrderDetail,order_details.total as totalOrderDetail')
            ->join('products', 'order_details.product', '=', 'products.id')
            ->join('orders', 'order_details.orders', '=', 'orders.id')
            ->where("orders.customers", auth()->user()->id);
        return view('user.purchaseHistory', compact('orders'));
    }
}
