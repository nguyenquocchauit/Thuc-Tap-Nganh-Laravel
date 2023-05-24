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
            'email' => 'required|unique:users,email',
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'Incorrect name format',
            'email.required' => 'Email không được bỏ trống',
            'email.unique' => 'Email đã tồn tại',
        ];

    }
}
