<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
