<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer; // Thêm import cho model Customer
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Thêm import cho Hash

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Front-end-Admin.auth.login'); // Tạo view cho trang đăng nhập
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra thông tin đăng nhập
        $customer = Customer::where('email', $request->email)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            // Nếu đăng nhập thành công, tạo session cho khách hàng
            Auth::login($customer); // Đăng nhập người dùng

            // Chuyển hướng về trang chính
            return redirect()->intended('/demo')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu đăng nhập thất bại, trả về thông báo lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Mã hóa và lưu thông tin khách hàng mới
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password); // Mã hóa mật khẩu
        $customer->save();

        return redirect('/login')->with('success', 'Đăng ký thành công! Bạn có thể đăng nhập ngay bây giờ.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất
        return redirect('/login')->with('success', 'Bạn đã đăng xuất.');
    }
}
