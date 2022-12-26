<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginAdminController extends Controller
{
    //
    public function index()
    {
        return view(('admin.login.login'));
    }
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
            $user = Administrator::where('email', $request->email)->first();
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
    public function logout()
    {

        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
