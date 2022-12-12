<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterUserController extends Controller
{
    //
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'msg' => $validator->getMessageBag(),
            ]);
        } else {
            // get time now
            $currentTime = Carbon::now();
            // get max id
            $maxID = User::query()
                ->selectRaw('SUM(id) AS ID_Max')
                ->get();
                $maxID = $maxID+1;
            $user = new User();
            $user->id = $maxID;
            $user->name = $request->name;
            $user->address = $request->address;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->updated_at = $currentTime->toDateTimeString();
            $user->role = '0';
            $user->save();
            return response()->json([
                'status' => 200,
                'msg' => 'Registered successfully',
            ]);
        }
    }
}
