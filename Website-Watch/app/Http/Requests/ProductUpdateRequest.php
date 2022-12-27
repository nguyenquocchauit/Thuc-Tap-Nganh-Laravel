<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name_product'=>'required', 
            'price_product'=>'required|min:0',
            'discount_product'=>'required|min:0|max:100',
            'quantity_product'=>'required|integer|min:0|max:10000',
            'image.*' => 'image|required|mimes:jpg,png,jpeg'
            // 'image_1' => 'image|mimes:jpg,png,jpeg',
            // 'image_2' => 'image|mimes:png,jpg,webp',
            // 'image_3' => 'image|mimes:png,jpg,webp',
            // 'image_4' => 'image|mimes:png,jpg,webp',
            // 'image_5' => 'image|mimes:png,jpg,webp',
            // 'image_6' => 'image|mimes:png,jpg,webp'
        ];
    }

    public function messages()
    {
        return [
            'name_product.required' => 'Tên sản phẩm không được bỏ trống',
            'price_product.required' => 'Giá sản phẩm không được bỏ trống',
            'price_product.min' => 'Giá sản phẩm phải là số dương',
            'discount_product.required' => 'Giảm giá sản phẩm không được bỏ trống',
            'discount_product.min' => 'Giảm giá sản phẩm phải là số dương',
            'discount_product.max' => 'Giảm giá sản phẩm phải nhỏ hơn 100',
            'quantity_product.required' => 'Số lượng kho không được bỏ trống',
            'quantity_product.integer' => 'Số lượng kho phải là số nguyên',
            'quantity_product.min' => 'Số lượng kho phải là số dương',
            'quantity_product.max' => 'Số lượng kho phải nhỏ hơn 10000',
            'image.*.required' => 'Ảnh sản phảm không được bỏ trống',
            'image.*.mines' => 'Ảnh sản phẩm chỉ nhận 3 định dạng:png,jpg,webp',
            'image.*.image' => 'Ảnh sản phẩm phải là một hình ảnh'
        ];
    }
}
