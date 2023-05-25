<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class BrandUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('brands')->ignore($this->id), 'regex:/^[a-zA-Z0-9\s\p{L}]+$/u'],
            'slug' => [Rule::unique('brands')->ignore($this->id)],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Empty name',
            'name.unique' => 'Name already exists',
            'name.regex' => 'Incorrect name format',
            'slug.unique' => 'Slug already exists',
        ];
    }
}
