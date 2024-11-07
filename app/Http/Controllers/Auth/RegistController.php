<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Authrequest;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class RegistController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('Front-end-Admin.auth.register');
    }

    public function register(Authrequest $request)
    {
        $customer = Customer::create([
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phoneNo'),
            'verification_token' => Str::random(32), // Tạo token xác thực
        ]);

        // Gửi email xác thực
        Mail::to($customer->email)->send(new VerifyEmail($customer));
    }
    public function verify($token)
    {
        $customer = Customer::where('verification_token', $token)->first();

        if ($customer) {
            $customer->update(['is_verified' => true, 'verification_token' => null]);
            return redirect()->away('https://www.youtube.com')->with('status', 'Tài khoản đã được xác thực!');
        } else {
            return redirect()->route('register')->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
        }
    }   
}
