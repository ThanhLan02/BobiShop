<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'phone' => ['required','regex:/^(\+\d{1,3}[- ]?)?\(?\d{3}\)?[- ]?\d{3}[- ]?\d{4}$/'],
            'address' => ['required'],
            'birthday' => ['required'],
            'gender' => ['required','string'],
            'image' => 'string|required',
            'description' => ['required','string'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:6'],
            'repassword' => ['required','same:password'],
            'role' => ['required','in:admin,user'],
            'status' => ['required','string','in:active'],
            
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
            'gender.string' => 'Giới tính phải là chuỗi ký tự',
            'birthday.required' => 'Bạn chưa nhập Ngày sinh',
            'image.required' => 'Bạn chưa chọn Hình ảnh',
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
