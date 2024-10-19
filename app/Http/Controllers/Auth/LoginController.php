<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Nếu đăng nhập thành công, chuyển hướng về trang chính
            return redirect()->intended('/demo')->with('success', 'Đăng nhập thành công!');
        }

        // Nếu đăng nhập thất bại, trả về thông báo lỗi
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất
        return redirect('/login')->with('success', 'Bạn đã đăng xuất.');
    }
}
