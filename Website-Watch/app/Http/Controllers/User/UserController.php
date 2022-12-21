<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $profile = User::find($request->id);
        if ($profile && Hash::check($request->password, $profile->password)) {
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
                    $msgPhone = null;
                    $msgEmail = null;
                    $messages = $validator->errors()->all();
                    for ($i = 0; $i < count($messages); $i++) {
                        if ($messages[$i] == "The phone number has already been taken.") {
                            $msgPhone = "The phone number has already been taken.";
                        }
                        if ($messages[$i] == "The email has already been taken.") {
                            $msgEmail = "The email has already been taken.";
                        }
                    }
                    return response()->json([
                        'status' => 500,
                        'msg' => "Error",
                        'email' => $msgEmail,
                        'phone' => $msgPhone,
                    ]);
                } else {

                    $update = $request->only('name', 'phone_number', 'email', 'address');
                    if ($request->changePass) {
                        $update['password'] = Hash::make($request->changePass);
                    }
                    $profile->update($update);
                    return response()->json([
                        'status' => 200,
                        'msg' => "Update information successfully",
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => 500,
                'msg' => 'Cofirm password incorrect',
            ]);
        }
    }
}
