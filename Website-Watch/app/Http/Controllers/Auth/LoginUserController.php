<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginUserController extends Controller
{
    //
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => $validator->getMessageBag(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('loggedInUser', $user->id);
                    return response()->json([
                        'status' => 1,
                        'msg' => 'Login success'
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'msg' => 'fail'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'msg' => 'User not found'
                ]);
            }
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
