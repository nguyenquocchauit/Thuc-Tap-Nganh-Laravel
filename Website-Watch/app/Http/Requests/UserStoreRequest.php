<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:30',
            'password_confirmation'=>'required',
            'role'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'phone_number.required' => 'Số điện thoại không được bỏ trống',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu không được nhỏ hơn 6 kí tự',
            'password.max' => 'Mật khẩu không được lớn hơn 30 kí tự',
            'password_confirmation.required' => 'Nhập lại mật khẩu không được bỏ trống',
            'role.required' => 'Vai trò chưa được chọn'
        ];
    }
}
