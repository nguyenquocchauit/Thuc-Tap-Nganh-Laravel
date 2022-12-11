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
        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            return response()->json(array(
                'status' => '1',
                'msg' => 'Login success'
            ), 200);
        } else {
            return response()->json(array(
                'status' => '0',
                'msg' => 'Login fail'
            ), 200);
        }


        // $credentials = [
        //     'email' => $request['email'],
        //     'password' => $request['password'],
        // ];

        // if (Auth::attempt($credentials)) {
        //     return response()->json(array(
        //         'status' => '1',
        //         'msg' => 'Login success'
        //     ), 200);
        // }
        //return ($request->all());
        // return response()->json(array(
        //     'status' => '0',
        //     'msg' => 'Login fail'
        // ), 200);
    }
}
