<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'brand_id'=>'required',
            'product_category_id'=>'required',
            'price_product'=>'required|min:0',
            'discount_product'=>'required|min:0|max:100',
            'quantity_product'=>'required|integer|min:0|max:10000',
            'image_1' => 'required|image|mimes:jpg,png,jpeg',
            'image_2' => 'required|image|mimes:png,jpg,webp',
            'image_3' => 'required|image|mimes:png,jpg,webp',
            'image_4' => 'required|image|mimes:png,jpg,webp',
            'image_5' => 'required|image|mimes:png,jpg,webp',
            'image_6' => 'required|image|mimes:png,jpg,webp'
        ];
    }

    public function messages()
    {
        return [
            'name_product.required' => 'Tên sản phẩm không được bỏ trống',
            'brand_id.required' => 'Hãng chưa được chọn',
            'product_category_id.required' => 'Loại chưa được chọn',
            'price_product.required' => 'Giá sản phẩm không được bỏ trống',
            'price_product.min' => 'Giá sản phẩm phải là số dương',
            'discount_product.required' => 'Giảm giá sản phẩm không được bỏ trống',
            'discount_product.min' => 'Giảm giá sản phẩm phải là số dương',
            'discount_product.max' => 'Giảm giá sản phẩm phải nhỏ hơn 100',
            'quantity_product.required' => 'Số lượng kho không được bỏ trống',
            'quantity_product.integer' => 'Số lượng kho phải là số nguyên',
            'quantity_product.min' => 'Số lượng kho phải là số dương',
            'quantity_product.max' => 'Số lượng kho phải nhỏ hơn 10000',
            'image_1.mines' => 'Ảnh sản phẩm chỉ nhận 3 định dạng:png,jpg,webp',
            'image_1.required' => 'Ảnh 1 chưa được chọn',
            'image_2.required' => 'Ảnh 2 chưa được chọn',
            'image_3.required' => 'Ảnh 3 chưa được chọn',
            'image_4.required' => 'Ảnh 4 chưa được chọn',
            'image_5.required' => 'Ảnh 5 chưa được chọn',
            'image_6.required' => 'Ảnh 6 chưa được chọn',
            'image_1.image' => 'Ảnh 1 phải là một hình ảnh',
            'image_2.image' => 'Ảnh 2 phải là một hình ảnh',
            'image_3.image' => 'Ảnh 3 phải là một hình ảnh',
            'image_4.image' => 'Ảnh 4 phải là một hình ảnh',
            'image_5.image' => 'Ảnh 5 phải là một hình ảnh',
            'image_6.image' => 'Ảnh 6 phải là một hình ảnh',

        ];
    }
}
