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
            'id' => 'required',
            'name'=>'required',
            'slug'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Id không được bỏ trống',
            'name.required' => 'Tên không được bỏ trống',
            'slug.required' => 'Slug không được bỏ trống'
        ];
    }
}
