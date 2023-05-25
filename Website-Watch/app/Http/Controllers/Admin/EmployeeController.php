<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Administrator;
use App\Models\Role;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function create()
    {
        $title = 'Thêm nhân viên';
        return view('admin.employee.create', compact('title'));
    }
    public function store(EmployeeRequest $request)
    {
        $employee = new Administrator();
        $maxID = $employee->maxID();
        $maxID = $maxID[0]->ID_Max;
        $maxID += 1;
        $now = now()->setTimezone('Asia/Ho_Chi_Minh');
        $data = [
            "id" => $maxID,
            "name" => $request->name,
            "avt" => Str::slug($request->name) . $maxID,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role,
            "create_at" => $now,
            "updated_at" => $now

        ];
        $request->file('image_profile')->storeAs('public/images/employee/', Str::slug($request->name) . $maxID);
        Administrator::create($data);
        return response()->json([
            'status' => 200,
            'msg' => "Create employee successfully",
        ]);
    }
    public function edit($id)
    {
        $title = 'Cập nhật người dùng';

        // Kiểm tra xem id có tồn tại hay không
        if ($id) {
            // Lấy thông tin của một đối tượng Administrator với id là $id
            $employee = Administrator::select(
                DB::raw("*, DATE_FORMAT(create_at,'%H:%i:%s %d-%m-%Y') as create_at"),
                DB::raw("DATE_FORMAT(updated_at,'%H:%i:%s %d-%m-%Y') as update_at")
            )->find($id);

            // Tách chuỗi địa chỉ của đối tượng Administrator thành hai phần
            $employeeAddress = explode(", ", $employee->address);
            $address = $employeeAddress[0] ?? "";

            // Truyền các biến vào view 'admin.employee.edit'
            return view('admin.employee.edit', compact('title', 'employee', 'address'));
        }

        // Nếu không có id, trả về view 'admin.login'
        return view('admin.login');
    }

    public function editEmployee($id)
    {
        // Lấy thông tin của một đối tượng Administrator với id là $id
        $user = Administrator::find($id);

        // Tách chuỗi địa chỉ của đối tượng Administrator thành ba phần
        $userAddress = explode(", ", $user->address);
        $city = $userAddress[3] ?? "";
        $district = $userAddress[2] ?? "";
        $ward = $userAddress[1] ?? "";

        // Truyền các biến vào một đối tượng Response
        return response()->json([
            'status' => 200,
            'city' => $city,
            'district' => $district,
            'ward' => $ward,
        ]);
    }
    public function destroy(Request $request)
    {
        Administrator::destroy($request->id);
        return response()->json([
            'status' => 200,
            'msg' => 'Delete employee successfully'
        ]);
    }
}
