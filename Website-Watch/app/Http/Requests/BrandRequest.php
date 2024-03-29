<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'unique:brands,name', 'regex:/^[a-zA-Z0-9\s\p{L}]+$/u'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Empty name',
            'name.unique' => 'Name already exists',
            'name.regex' => 'Incorrect name format',
        ];
    }
}
