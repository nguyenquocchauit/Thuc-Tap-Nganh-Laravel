<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user.profile');
    }
    public function updateProfile(Request $request)
    {
        if ($request->action == "Save profile") {
            $validator = Validator::make($request->all(), [
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($request->id),
                ],
                'phone_number' => [
                    'required',
                    Rule::unique('users')->ignore($request->id),
                ],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 500,
                    'msg' => "Error",
                    'data' =>$validator->getMessageBag(),
                ]);
            } else {
                $profile = User::find($request->id);
                if ($request->changePass != null) {
                } else {
                }
            }
        } else {
            return response()->json([
                'status' => 500,
                'msg' => 'Update profile error',
            ]);
        }
    }
}
