<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'=>'required',
            'phone_number'=>'required',
            'email'=>'required',
            'password'=>'min:6|max:30',
            'role'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'phone_number.required' => 'Số điện thoại không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'password.min' => 'Mật khẩu không được nhỏ hơn 6 kí tự',
            'password.max' => 'Mật khẩu không được lớn hơn 30 kí tự',
            'role.required' => 'Vai trò chưa được chọn'
        ];
    }
}
