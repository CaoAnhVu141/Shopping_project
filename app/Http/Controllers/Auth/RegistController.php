<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Authrequest;
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
            'password' => Hash::make($request->input('password')), // Mã hóa mật khẩu
            'phone' => $request->input('phoneNo'),
        ]);
    }
}
