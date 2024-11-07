<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class UserController extends Controller
{
    public function showForgotPassword()
    {
        return view('Front-end-Shopping.auth.forgot_password');
    }

    public function submitFormForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers|max:50',
        ], [
            'email.required' => 'Vui lòng nhập tài khoản email hợp lệ',
            'email.exists' => 'Email không tồn tại trong hệ thống',
            'email.max' => 'Email không được phép dài hơn 50 ký tự',
        ]);

        $email = $request->input('email');
        $token = strtoupper(Str::random(10));
        $customer = Customer::where('email', $email)->first();
        $customer->update(['token' => $token]);

        $resetLink = route('auth.getPassword', ['customer' => $customer->id_customer, 'token' => $token]);

        try {
            Mail::send('emails.check_email_forget', compact('customer', 'resetLink'), function ($email) use ($customer) {
                $email->subject('Shopping', 'Lấy lại mật khẩu');
                $email->to($customer->email, $customer->name);
            });
            return redirect()->back()->with('success', 'Vui lòng kiểm tra email để thực hiện đặt lại mật khẩu');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi gửi email. Vui lòng thử lại sau.');
        }
    }

    public function showGetPassword(Customer $customer, $token)
    {
        if ($customer->token && $customer->token === $token) {
            return view('Front-end-Shopping.auth.get_password', compact('customer', 'token'));
        }
        return abort(404);
    }

    public function submitGetPassword(Customer $customer, $token, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'string',
                'min:8',
                'max: 20',
                'regex:/[A-Z]/',
                'regex:/[!@#$%^&*(),.?":{}|<>]/',
            ],
            'confirm_password' => 'required|same:password',
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu phải không được vượt quá 20 ký tự',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 ký tự viết hoa và 1 ký tự đặc biệt',
            'confirm_password.required' => 'Vui lòng nhập lại mật khẩu',
            'confirm_password.same' => 'Mật khẩu nhập lại không khớp',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Đã xảy ra lỗi khi xác thực. Vui lòng thử lại.');
        }

        $password_hash = bcrypt($request->input('password'));
        $customer->update(['password' => $password_hash, 'token' => null]);

        // return redirect()->route('auth.password')->with('status', 'Mật khẩu đã được cập nhật thành công!');
    }
}
