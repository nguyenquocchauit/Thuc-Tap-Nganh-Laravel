<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[a-zA-ZÀ-ỹ ]*$/'],
            'phone_number' => ['required', 'regex:/(09|03|07|08|05)+([0-9]{8})\b/'],
            'email' => ['required', 'unique:users,email', 'regex:/^[^ ]+@[^ ]+\.[a-z]{2,3}$/'],
            'address' => ['required'],
            'password' => ['required', 'min:6', 'max:30'],
            'password_confirmation' => ['required', 'min:6', 'max:30', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Empty name',
            'name.regex' => 'Incorrect name format',
            'phone_number.required' => 'Empty phone',
            'phone_number.regex' => 'Incorrect phone format',
            'email.required' => 'Empty email',
            'email.unique' => 'Email already exists',
            'email.regex' => 'Incorrect email format',
            'address.required' => 'Empty address',
            'password.required' => 'Empty password',
            'password.min' => 'Min',
            'password.max' => 'Max',
            'password_confirmation.required' => 'Empty password confirmation',
            'password_confirmation.min' => 'Min',
            'password_confirmation.max' => 'Max',
            'password_confirmation.same' => "Doesn't match",
        ];
    }
}
