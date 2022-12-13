<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard as AuthGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\Guard;

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
                    $credentials = $request->only('email', 'password');
                    Auth::attempt($credentials);
                    return response()->json([
                        'status' => 200,
                        'msg' => 'Login successfully'
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'msg' => 'Pass is incorrect'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'msg' => 'Email not found'
                ]);
            }
        }
    }
    public function getNameUser()
    {
        $name = null;
        $name = Auth::user();
        return $name;
        // $name = null;
        // if (Auth::user() != null) {
        //     $name = Auth::user()->name;
        //     $name = explode(" ", $name);
        //     $name = $name[sizeof($name) - 2] . " " . $name[sizeof($name) - 1];
        // }
        // return $name;
        //return view('layouts.app', compact('name'));
    }
    public function logout()
    {

        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
