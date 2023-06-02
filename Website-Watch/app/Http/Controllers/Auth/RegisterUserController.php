<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterUserController extends Controller
{
    //
    public function Register(UserRequest $request)
    {
        $user = User::make($request->all());
        $user->id = "kh" . (User::count() + 1) . now()->setTimezone('Asia/Ho_Chi_Minh')->format('dmY');
        $user->password = Hash::make($request->password);
        $user->role = 0;
        $user->created_at = now()->setTimezone('Asia/Ho_Chi_Minh');
        $user->updated_at = now()->setTimezone('Asia/Ho_Chi_Minh');
        $user->save();

        return response()->json([
            'status' => 200,
            'msg' => "Register customer successfully",
        ]);
    }
}
