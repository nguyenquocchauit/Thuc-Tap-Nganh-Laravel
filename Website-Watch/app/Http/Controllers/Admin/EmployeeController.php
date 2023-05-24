<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    //
    private $employee;
    public function __construct()
    {
        $this->employee = new Administrator();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Nhân viên';
        $employees = Administrator::get();
        return view('admin.employee.index', compact('title', 'employees'));
    }
    public function edit($id)
    {
        $title = 'Cập nhật người dùng';
        if ($id) {
            $employee = Administrator::select(
                DB::raw("*, DATE_FORMAT(create_at,'%H:%i:%s %d-%m-%Y') as create_at"),
                DB::raw("DATE_FORMAT(updated_at,'%H:%i:%s %d-%m-%Y') as update_at")
            )->find($id);
            $employeeAddress = explode(", ", $employee->address);
            $address = $employeeAddress[0] ?? "";
            return view('admin.employee.edit', compact('title', 'employee', 'address'));
        }
        return view('admin.login');
    }
    public function editEmployee($id)
    {
        $user = Administrator::find($id);
        $userAddress = explode(", ", $user->address);
        $city = $userAddress[3] ?? "";
        $district = $userAddress[2] ?? "";
        $ward = $userAddress[1] ?? "";
        return response()->json([
            'status' => 200,
            'city' => $city,
            'district' => $district,
            'ward' => $ward,
        ]);
    }
}
