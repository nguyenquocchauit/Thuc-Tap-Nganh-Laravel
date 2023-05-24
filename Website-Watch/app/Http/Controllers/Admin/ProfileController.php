<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $employee = Administrator::select(
                DB::raw("*, DATE_FORMAT(create_at,'%H:%i:%s %d-%m-%Y') as create_at"),
                DB::raw("DATE_FORMAT(updated_at,'%H:%i:%s %d-%m-%Y') as update_at")
            )->find($id);
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
}
