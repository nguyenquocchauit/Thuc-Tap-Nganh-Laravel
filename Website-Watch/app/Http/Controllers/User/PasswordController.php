<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    //
    public function reset_password()
    {
        return view("user.reset_password");
    }
    public function recover_password(Request $request)
    {
        $title_mail = "Khôi phục mật khẩu TC Watch";
        $time = now()->setTimezone('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $customer = User::where('email', $request->email)->exists();
        if ($customer == false) {
            return response()->json([
                'status' => 422,
                'msg' => 'Email is not registered',
            ]);
        } else {
            $token_random = Str::random(100);
            User::where('email',  $request->email)
                ->update([
                    "token" => $token_random,
                ]);
            //send mail
            $to_email = $request->email; // send to this email
            $link_reset_pass = url('/update-new-password?email=' . $to_email . '&token=' . $token_random);
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
        $customer = User::where('email', $request->email)->where('token', "=", $request->token)->exists();
        if ($customer == false) {
            return response()->json([
                'status' => 422,
                'msg' => 'Error',
            ]);
        } else {
            User::where('email',  $request->email)
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
