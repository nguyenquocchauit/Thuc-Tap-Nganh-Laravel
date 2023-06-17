<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class PasswordEmployeeController extends Controller
{
    //
    public function reset_password()
    {
        return view("admin.login.reset_password");
    }
    public function recover_password(Request $request)
    {
        $title_mail = "Khôi phục mật khẩu TC Watch";
        $time = now()->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $customer = Administrator::where('email', $request->email)->exists();
        if ($customer == false) {
            return response()->json([
                'status' => 422,
                'msg' => 'Email is not registered',
            ]);
        } else {
            $token_random = Str::random(100);
            Administrator::where('email',  $request->email)
                ->update([
                    "token" => $token_random,
                ]);
            //send mail
            $to_email = $request->email; // send to this email
            $link_reset_pass = url('/update-new-password-employee?email=' . $to_email . '&token=' . $token_random);
            $data = array("name" => $title_mail, "body" => $link_reset_pass, "email" => $request->email, "time" => $time);
            Mail::send("user.forget_password_notify", ['data' => $data], function ($message) use ($title_mail, $request) {
                $message->to($request->email)->subject($title_mail); // send this mail with subject
                $message->from("tcwatchnhatrang@gmail.com", "TC Watch");
            });
            return response()->json([
                'status' => 200,
                'msg' => 'Check mail',
            ]);
        }
    }
    public function update_password(Request $request)
    {
        $customer = Administrator::where('email', $request->email)->where('token', "=", $request->token)->exists();
        if ($customer == false) {
            return response()->json([
                'status' => 422,
                'msg' => 'Error',
            ]);
        } else {
            Administrator::where('email',  $request->email)
                ->update([
                    "password" => Hash::make($request->password),
                    "token" => "",
                ]);
            return response()->json([
                'status' => 200,
                'msg' => 'Reset password successfully',
            ]);
        }
    }
}
