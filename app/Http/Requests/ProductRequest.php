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
            'name' =>'required',
            'description' =>'required|nullable',
            'quantity' =>'required|numeric',
            'category_id' =>'required|exists:category,id',
            'brand_id' =>'required|exists:brands,id',
            'image' => 'string|required',
            'condition' =>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập Tên',
            'name.max' => 'Tên sản phẩm phải nhỏ hơn 255 ký tự',
            'description.required' => 'Bạn chưa nhập Mô tả',
            'quantity.required' => 'Bạn chưa nhập Số lượng',
            'quantity.numeric' => 'Số lượng phải là số',
            'category_id.required' => 'Bạn chưa chọn Thể loại',
            'category_id.exists' => 'Mã loại không hợp lệ',
            'brand_id.required' => 'Bạn chưa chọn Thể thương hiệu',
            'brand_id.exists' => 'Mã thương hiệu không hợp lệ',
            'conditions.required' => 'Chưa chọn',
        ];
    }
}
