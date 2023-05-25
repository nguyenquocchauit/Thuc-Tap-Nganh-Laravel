<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    private $employee;
    public function __construct()
    {
        $this->employee = new Administrator();
    }

    public function profile()
    {
        $title = 'Cập nhật người dùng';
        return view('admin.profile', compact('title'));
    }
    public function edit($id)
    {


        if ($id) {
            if (!(auth()->guard("admin")->user()->id == $id))
                return Redirect('/admin/profile/' . auth()->guard("admin")->user()->id . '/edit');
            $employee = Administrator::find($id);
            $employeeAddress = explode(", ", $employee->address);
            $address = $employeeAddress[0] ?? "";
            return view('admin.profile', compact('title', 'employee', 'address'));
        }
        return Redirect('/admin/login');
    }
    public function editEmployee($id)
    {
        $employee = Administrator::select(
            DB::raw("*, DATE_FORMAT(create_at,'%H:%i:%s %d-%m-%Y') as create_at"),
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
    public function update(ProfileRequest $request, $id)
    {
        $now = now()->setTimezone('Asia/Ho_Chi_Minh');
        Administrator::where('id', $id)->update($request->only(['name', 'phone_number', 'address', 'email']) + ['updated_at' => $now]);

        return response()->json([
            'status' => 200,
            'msg' => 'Update profile successfully',
        ]);
    }


    public function updatePassword(ProfilePasswordRequest $request, $id)
    {
        $user = Administrator::find($id);
        $user->password = Hash::make($request->newPass);
        $user->updated_at = now()->setTimezone('Asia/Ho_Chi_Minh');
        $user->save();

        return response()->json([
            'status' => 200,
            'msg' => 'Update password successfully',
        ]);
    }
}
