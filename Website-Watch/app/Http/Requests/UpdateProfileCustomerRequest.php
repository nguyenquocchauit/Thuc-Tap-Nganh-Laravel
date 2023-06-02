<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UpdateProfileCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[a-zA-ZÀ-ỹ ]*$/'],
            'phone_number' => ['required', 'regex:/(09|03|07|08|05)+([0-9]{8})\b/'],
            'email' => ['required', Rule::unique('users')->ignore($this->id), 'regex:/^[^ ]+@[^ ]+\.[a-z]{2,3}$/'],
            'address' => ['required'],

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

        ];
    }
}
