<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $request->validate(
            [
                'email' => 'required|email|exists:customers',
            ],
            [
                'email.required' => 'Vui lòng nhập tài khoản email hợp lệ',
                'email.exists' => 'Email không tồn tại trong hệ thống'
            ]
        );

        $email = $request->input('email');
        $token = strtoupper(Str::random(10));
        $customer = Customer::where('email', $email)->first();
        $customer->update(['token' => $token]);

        $resetLink = route('auth.getPassword', ['customer' => $customer->id_customer, 'token' => $token]);

        Mail::send('emails.check_email_forget', compact('customer', 'resetLink'), function ($email) use ($customer) {
            $email->subject('Shopping', 'Lấy lại mật khẩu');
            $email->to($customer->email, $customer->name);
        });

        return redirect()->back()->with('Success', 'Vui lòng kiểm tra email để thực hiện đặt lại mật khẩu');
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
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $password_hash = bcrypt($request->input('password'));
        $customer->update(['password' => $password_hash, 'token' => null]);

        // return redirect()->route('auth.password')->with('status', 'Mật khẩu đã được cập nhật thành công!');
    }
}