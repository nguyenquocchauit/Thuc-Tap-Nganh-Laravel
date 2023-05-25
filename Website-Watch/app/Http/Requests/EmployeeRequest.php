<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[a-zA-ZÀ-ỹ ]*$/'],
            'phone_number' => ['required','unique:administrator,phone_number', 'regex:/(09|03|07|08|05)+([0-9]{8})\b/'],
            'email' => ['required', 'unique:administrator,email', 'regex:/^[^ ]+@[^ ]+\.[a-z]{2,3}$/'],
            'address' => ['required'],
            'password' => ['required', 'min:6', 'max:30'],
            'password_confirmation' => ['required', 'min:6', 'max:30', 'same:password'],
            'role' => ['required'],
            'image_profile' => 'image|required|mimes:jpg,png,jpeg'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Empty name',
            'name.regex' => 'Incorrect name format',
            'role.required' => 'Empty role',
            'address.required' => 'Empty address',
            'phone_number.required' => 'Empty phone',
            'phone_number.unique' => 'Phone already exists',
            'phone_number.regex' => 'Incorrect phone format',
            'email.required' => 'Empty email',
            'email.unique' => 'Email already exists',
            'email.regex' => 'Incorrect email format',
            'password.required' => 'Empty password',
            'password.min' => 'Min',
            'password.max' => 'Max',
            'password_confirmation.required' => 'Empty password confirmation',
            'password_confirmation.same' => "Doesn't match",
            'image_profile.image' => 'Incorrect image format',
            'image_profile.required' => 'Empty image',
            'image_profile.mimes' => 'jpg, png, jpeg.'
        ];
    }
}
