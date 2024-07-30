<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'url_image' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ];
    }
    public function messages()
    {
        return [
            'url_image.required' => 'Vui lòng chọn ảnh.',
            'product_id.required' => 'Chưa chọn sản phẩm.',
            'product_id.exists' => 'Không tìm thấy sản phẩm.',
        ];
    }
}
