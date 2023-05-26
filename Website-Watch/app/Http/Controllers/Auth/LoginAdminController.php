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
    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.login.login', compact('user'));
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'msg' => $validator->getMessageBag(),
            ]);
        } else {
            $user = Administrator::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                        Session::flash('success', 'Login successfully');
                        return response()->json([
                            'status' => 200,
                            'msg' => 'Login successfully',
                            "data" => Auth::guard('admin')->user()
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 422,
                        'msg' => 'Pass is incorrect'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 422,
                    'msg' => 'Email not found'
                ]);
            }
        }
    }

    public function logout()
    {

        Session::flush();
        Auth::logout();
        return Redirect('/admin/login');
    }
}
