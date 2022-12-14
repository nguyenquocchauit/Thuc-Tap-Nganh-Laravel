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
        // check email and phone, already exist?
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users',
            'phone_number' => 'required|unique:users',
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
                ->selectRaw('MAX(id) AS ID_Max')
                ->get();
            // get max id from object maxID
            $ID = $maxID[0]['ID_Max'];
            $ID = (int)$ID  + 1;
            $user = new User();
            $user->id = $ID;
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
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
