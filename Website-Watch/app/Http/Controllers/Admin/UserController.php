<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
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
        $users = $this->users->getAllUsers($search);
        return view('admin.user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = 'Thêm  người dùng';
        $roles = Role::all();
        return view('admin.user.create', compact('title', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        // $valiName = Validator::make(['name' => $request->name], [
        //     'name' => ['required', 'regex:/^[a-zA-ZÀ-ỹ ]*$/'],
        // ]);
        // if ($valiName->fails()) return response()->json([
        //     'status' => 422,
        //     'msg' => 'Incorrect name format',
        // ]);
        // $valiPhone = Validator::make(['phone_number' => $request->phone_number], [
        //     'phone_number' => ['required', 'regex:/(09|03|07|08|05)+([0-9]{8})\b/'],
        // ]);
        // if ($valiPhone->fails()) return response()->json([
        //     'status' => 422,
        //     'msg' => 'Incorrect phone format',
        // ]);
        // $valiEmail = Validator::make(['email' => $request->email], [
        //     'email' => ['required', 'unique:users,email', 'regex:/^[^ ]+@[^ ]+\.[a-z]{2,3}$/'],
        // ]);
        // if ($valiEmail->fails()) return response()->json([
        //     'status' => 422,
        //     'msg' => 'Incorrect email format',
        // ]);
        // if ($request->password != $request->password_confirmation) {
        //     return response()->json([
        //         'status' => 422,
        //         'msg' => 'Password incorrect'
        //     ]);
        // }
        // // $data = $request->all();
        // $user = new User();
        // $maxID = $user->maxID();
        // $maxID = $maxID[0]->ID_Max;
        // $maxID += 1;
        // $data = [
        //     "id" => $maxID,
        //     "name" => $request->name,
        //     "phone_number" => $request->phone_number,
        //     "address" => $request->address,
        //     "email" => $request->email,
        //     "password" => Hash::make($request->password),
        //     "role" => 0,

        // ];
        // // $data['password'] = bcrypt($request->get('password'));
        // User::create($data);
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
        $user = User::find($id);
        $title = 'Cập nhật người dùng';
        $userAddress = explode(", ", $user->address);
        $address = $userAddress[0] ?? "";
        return view('admin.user.edit', compact('title', 'user', 'address'));
    }
    public function editCustomer($id)
    {
        $user = User::find($id);
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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valiName = Validator::make(['name' => $request->name], [
            'name' => ['required', 'regex:/^[a-zA-ZÀ-ỹ ]*$/'],
        ]);
        if ($valiName->fails()) return response()->json([
            'status' => 422,
            'msg' => 'Incorrect name format',
        ]);
        $valiPhone = Validator::make(['phone_number' => $request->phone_number], [
            'phone_number' => ['required', 'regex:/(09|03|07|08|05)+([0-9]{8})\b/'],
        ]);
        if ($valiPhone->fails()) return response()->json([
            'status' => 422,
            'msg' => 'Incorrect phone format',
        ]);
        $valiEmail = Validator::make(['email' => $request->email], [
            'email' => ['required', 'regex:/^[^ ]+@[^ ]+\.[a-z]{2,3}$/'],
        ]);
        if ($valiEmail->fails()) return response()->json([
            'status' => 422,
            'msg' => 'Incorrect email format',
        ]);

        // //Xu ly password
        $users = User::find($id);
        $data = [
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ];
        $users->update($data);
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
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/admin/user')->with('success', 'Xóa người dùng thành công');
    }
}
