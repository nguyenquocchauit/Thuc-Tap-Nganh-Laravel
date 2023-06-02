<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ProfilePasswordCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $oldPass = request()->input('oldPass');
        return [
            'oldPass' => [
                'required',
                function ($attribute, $value, $fail) use ($oldPass) {
                    // Kiểm tra xem người dùng đã đăng nhập hay chưa
                    if (auth()->check() && !Hash::check($oldPass, auth()->user()->password)) {
                        $fail(__("Doesn't match"));
                    }
                },
            ],
            'newPass' => 'required|min:6|max:30',
            'confirmPass' => 'required|min:6|max:30|same:newPass',
        ];
    }


    public function messages()
    {
        return [
            'oldPass.required' => 'Empty password',
            'oldPass.exists' => "Doesn't match",
            'newPass.required' => 'Empty new password',
            'newPass.min' => 'Min',
            'newPass.max' => 'Max',
            'confirmPass.required' => 'Empty confirm password',
            'confirmPass.same' => "Doesn't match",
        ];
    }
}
