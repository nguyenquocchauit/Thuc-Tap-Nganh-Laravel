<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        if(!empty($request->search)) {
            $search = $request->search;
        }
        $users = $this->users->getAllUsers($search);
        return view('admin.user.index',compact('title','users'));
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
        return view('admin.user.create',compact('title','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {

        if($request->get('password') != $request->get('password_confirmation')) {
            return back()->with('error','Bạn nhập  mật khẩu không khớp, vui lòng nhập lại');
        }
        // $data = $request->all();
        $user = new User();
        $maxID = $user->maxID();
        $maxID = $maxID[0]->ID_Max;
        $maxID += 1;
        $data = [
            "id" => $maxID,
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role

        ];
        // $data['password'] = bcrypt($request->get('password'));
        User::create($data);
        return redirect('admin/user')->with('success', 'Thêm người dùng thành công');
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
        return view('admin.user.show',compact('title','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        $title = 'Cập nhật người dùng';
        $roles = Role::all();
        return view('admin.user.edit',compact('title','user','roles'));
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
        //Xu ly password
        $users = User::find($id);
        $data = [
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role
        ];
        $users->update($data);
        return redirect('/admin/user')->with('success', 'Cập nhật người dùng thành công');
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
