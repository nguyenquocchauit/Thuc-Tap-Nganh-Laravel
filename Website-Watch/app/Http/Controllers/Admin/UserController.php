<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new User();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Danh sách người dùng';
        //search
        $search = null;
        if (!empty($request->search)) {
            $search = $request->search;
        }
        $customers = $this->users->getAllUsers($search);
        return view('admin.user.index', compact('title', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = 'Thêm  người dùng';
        return view('admin.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $maxID = $user->maxID();
        $maxID = $maxID[0]->ID_Max;
        $maxID += 1;
        $now = now()->setTimezone('Asia/Ho_Chi_Minh');
        $data = [
            "id" => $maxID,
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => 0,
            "created_at" =>$now,
            "update_at"=>$now

        ];
        User::create($data);
        return response()->json([
            'status' => 200,
            'msg' => "Create customer successfully",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $title = 'Chi tiết người dùng';
        return view('admin.user.show', compact('title', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = User::find($id);
        $title = 'Cập nhật người dùng';
        $employeeAddress = explode(", ", $customer->address);
        $address = $customerAddress[0] ?? "";
        return view('admin.user.edit', compact('title', 'customer', 'address'));
    }
    public function editCustomer($id)
    {
        $customer = User::select(
            DB::raw("*, DATE_FORMAT(created_at,'%H:%i:%s %d-%m-%Y') as create_at"),
            DB::raw("DATE_FORMAT(updated_at,'%H:%i:%s %d-%m-%Y') as update_at")
        )->find($id);
        $customerAddress = explode(", ", $customer->address);
        $city = $customerAddress[3] ?? "";
        $district = $customerAddress[2] ?? "";
        $ward = $customerAddress[1] ?? "";
        $address = $customerAddress[0] ?? "";
        return response()->json([
            'status' => 200,
            'city' => $city,
            'district' => $district,
            'ward' => $ward,
            'address' => $address,
            'created_at' => $customer->create_at,
            'updated_at' => $customer->update_at,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {

        $customer = new User();
        User::where('id', $id)
            ->update([
                "name" => $request->name,
                "phone_number" => $request->phone_number,
                "address" => $request->address,
                "email" => $request->email,
                "updated_at" => $customer->currentTime(),
            ]);
        return response()->json([
            'status' => 200,
            'msg' => 'Update customer successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::destroy($request->id);
        return response()->json([
            'status' => 200,
            'msg' => 'Delete customer successfully'
        ]);
    }
}
