<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Authrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phoneNo' => 'required|string|regex:/^0[35789][0-9]{8}$/',
            'username' => 'required|max:50|regex:/^[a-zA-Z0-9]+$/',
            'password' => 'required|min:10|max:50|regex:/[A-Z]/|regex:/[a-z]/|regex:/[\W_]/',
            'confirmpassword' => 'required|same:password',
            'email' => [
                'required',
                'email',
                'max:50',
                'regex:/^[^\s]+@[^\s]+\.[^\s]+$/',
                'regex:/^(?!.*\.\.)[^\s]+$/',
                'unique:customers,email',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phoneNo.required' => 'Bạn chưa nhập số điện thoại',
            'phoneNo.string' => 'Số điện thoại phải là chuỗi ký tự',
            'phoneNo.regex' => 'Số điện thoại phải có đúng 10 chữ số và bắt đầu bằng 03, 05, 07, 08 hoặc 09',
            'username.required' => 'Username không được để trống.',
            'username.max' => 'Username không được dài quá 50 ký tự.',
            'username.regex' => 'Username chỉ được chứa ký tự chữ và số, không có ký tự đặc biệt hoặc khoảng trắng.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất 10 ký tự.',
            'password.max' => 'Mật khẩu không được dài quá 50 ký tự.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 chữ hoa, 1 chữ thường và 1 ký tự đặc biệt.',
            'confirmpassword.required' => 'Xác nhận mật khẩu không được để trống.',
            'confirmpassword.same' => 'Xác nhận mật khẩu phải giống với mật khẩu.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được dài quá 50 ký tự.',
            'email.regex' => 'Email không được có khoảng trắng và phải có dấu @.',
            'email.regex.1' => 'Email không được có hai dấu chấm liên tiếp.',
            'email.unique' => 'Email đã tồn tại.',
        ];
    }

}
