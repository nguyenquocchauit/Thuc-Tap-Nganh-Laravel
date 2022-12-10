<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // if (Auth::attempt($request->only('email', 'password'))) {
        //     return response()->json(array(
        //         'status' => '1',
        //         'msg' => 'Login success'
        //     ), 200);
        // }
        return response($credentials);
    }
}
