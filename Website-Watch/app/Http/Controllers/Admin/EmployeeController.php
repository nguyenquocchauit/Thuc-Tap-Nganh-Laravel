<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Administrator;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        //search
        $search = null;
        if (!empty($request->search)) {
            $search = $request->search;
        }
        $employees = $this->employee->getAllUsers($search);
        return view('admin.employee.index', compact('title', 'employees'));
    }
    public function create()
    {
        $title = 'Thêm nhân viên';
        return view('admin.employee.create', compact('title'));
    }
    public function store(EmployeeRequest $request)
    {
        // Tạo một đối tượng mới của lớp Administrator
        $employee = new Administrator();

        // Lấy ID lớn nhất hiện tại trong cơ sở dữ liệu
        $maxID = $employee->maxID();
        $maxID = $maxID[0]->ID_Max;
        $maxID += 1;

        // Lấy thời gian hiện tại theo múi giờ Asia/Ho_Chi_Minh
        $now = now()->setTimezone('Asia/Ho_Chi_Minh');

        // Tạo mảng dữ liệu mới cho nhân viên
        $data = [
            "id" => $maxID,
            "name" => $request->name,
            "avt" => Str::slug($request->name) . $maxID . ".png",
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role,
            "create_at" => $now,
            "updated_at" => $now
        ];

        // Lưu ảnh của nhân viên vào thư mục public/images/employee/
        $request->file('image_profile')->move(public_path('images/employee/'), Str::slug($request->name) . $maxID . ".png");

        // Thêm nhân viên mới vào cơ sở dữ liệu
        Administrator::create($data);

        // Trả về thông báo thành công
        return response()->json([
            'status' => 200,
            'msg' => "Create employee successfully",
        ]);
    }
    public function edit($id)
    {
        $title = 'Cập nhật người dùng';
        if ($id) {
            $employee = Administrator::find($id);
            if ($employee->role == "1" || Auth::guard('admin')->user()->id != $employee->id)
                return view('admin.employee.edit', compact('title', 'employee'));
            else return Redirect('/admin/employee');
        }
        return Redirect('/admin/login');
    }

    public function editEmployee($id)
    {
        // Lấy thông tin của một đối tượng Administrator với id là $id
        $employee = Administrator::select(
            DB::raw("*, DATE_FORMAT(create_at,'%H:%i:%s %d-%m-%Y') as create_at"),
            DB::raw("DATE_FORMAT(updated_at,'%H:%i:%s %d-%m-%Y') as update_at")
        )->find($id);

        // Tách chuỗi địa chỉ của đối tượng Administrator thành ba phần
        $employeeAddress = explode(", ", $employee->address);
        $city = $employeeAddress[3] ?? "";
        $district = $employeeAddress[2] ?? "";
        $ward = $employeeAddress[1] ?? "";
        $address = $employeeAddress[0] ?? "";

        // Truyền các biến vào một đối tượng Response
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
    public function update(EmployeeUpdateRequest $request, $id)
    {

        $employeer = Administrator::find($id);
        // Lấy thời gian hiện tại theo múi giờ Asia/Ho_Chi_Minh
        $now = now()->setTimezone('Asia/Ho_Chi_Minh');
        Administrator::where('id', $id)
            ->update([
                "name" => $request->name,
                "phone_number" => $request->phone_number,
                "address" => $request->address,
                "email" => $request->email,
                "updated_at" => $now,
                "role" => $request->role,
            ]);
        // Lưu ảnh của nhân viên vào thư mục public/images/employee/
        if (File::exists('images/employee/' . $employeer->avt)) {
            File::delete('images/employee/' . $employeer->avt);
        }
        $request->file('image_profile')->move(public_path('images/employee/'), $employeer->avt);

        return response()->json([
            'status' => 200,
            'msg' => 'Update employee successfully',
        ]);
    }

    public function destroy(Request $request)
    {
        // Tìm kiếm nhân viên theo id
        $employee = Administrator::findOrFail($request->id);
        // Kiểm tra nếu là người dùng hiện tại đang thực hiện thao tác xóa hoặc nhân viên xóa quản trị viên thì ngăn chặn
        if (Auth::guard('admin')->check() == false || Auth::guard('admin')->user()->id == $request->id) {
            return response()->json([
                'status' => 500,
                'msg' => 'Delete yourself'
            ]);
        }
        if (Auth::guard('admin')->check() == false || Auth::guard('admin')->user()->role == $request->role) {
            return response()->json([
                'status' => 500,
                'msg' => 'No permissions'
            ]);
        }

        // Kiểm tra xem ảnh của nhân viên có tồn tại không
        if (File::exists("images/employee/" . $employee->avt)) {
            // Nếu có, xóa ảnh đó
            File::delete("images/employee/" . $employee->avt);
        }

        // Xóa nhân viên khỏi cơ sở dữ liệu
        $employee->delete();

        // Trả về thông báo thành công
        return response()->json([
            'status' => 200,
            'msg' => 'Delete employee successfully'
        ]);
    }
}
