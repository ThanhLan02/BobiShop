<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' =>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'repassword' => 'required|string',
            'phone' => ['required','regex:/^(\+\d{1,3}[- ]?)?\(?\d{3}\)?[- ]?\d{3}[- ]?\d{4}$/'],
            'address' => 'required|max:255',
            'gender' => 'required',
            'description' => ['required','string'],
            'birthday' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập Họ Tên',
            'name.string' => 'Họ Tên phải là chuỗi ký tự',
            'name.max' => 'Họ Tên quá dài',
            'phone.required' => 'Bạn chưa nhập Số điện thoại',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'address.required' => 'Bạn chưa nhập Địa chỉ',
            'gender.required' => 'Bạn chưa nhập Giới tính',
            'birthday.required' => 'Bạn chưa nhập Ngày sinh',
            'description.required' => 'Bạn chưa nhập Mô tả',
            'email.required' => 'Bạn chưa nhập Email',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email quá dài',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập Mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
            'repassword.same' => 'Mật khẩu không đúng!',
        ];
    }
}
