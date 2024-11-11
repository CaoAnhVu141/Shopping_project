<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Front-end-Admin.auth.login');
    }

    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => [
                'required',
                'email',
                'max:50',
                'not_regex:/\s/', // Không có khoảng trắng
                'not_regex:/\.\./', // Không có 2 dấu chấm liên tiếp
            ],
            'password' => [
                'required',
                'string',
                'min:10', // Bắt buộc nhập tối thiểu 10 ký tự
                'regex:/[A-Z]/', // Ít nhất 1 chữ viết hoa
                'regex:/[a-z]/', // Ít nhất 1 chữ viết thường
                'regex:/[\W_]/', // Ít nhất 1 ký tự đặc biệt
                'max:50',
            ],
        ], [
            'email.required' => 'Vui lòng nhập vào Email của bạn!',
            'email.email' => 'Địa chỉ email không hợp lệ!',
            'email.max' => 'Xin lỗi, bạn đã nhập quá giới hạn email, chúng tôi chỉ hỗ trợ tối đa cho 50 ký tự!',
            'email.not_regex' => 'Email không được chứa khoảng trắng!',
            'email.not_regex.2' => 'Email không được có 2 dấu chấm liên tiếp!',
            'password.required' => 'Vui lòng nhập mật khẩu của bạn!',
            'password.min' => 'Mật khẩu phải có ít nhất 10 ký tự!',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 chữ viết hoa, 1 chữ viết thường và 1 ký tự đặc biệt!',
            'password.max' => 'Mật khẩu không được vượt quá 50 ký tự!',
        ]);

        // Kiểm tra thông tin đăng nhập
        $customer = Customer::where('email', $request->email)->first();

        if (!$customer) {
            // Nếu không tìm thấy email
            return back()->withErrors([
                'email' => 'Không tìm thấy email đã đăng ký. Nếu chưa đăng ký hãy nhấp vào đăng ký phía bên phải màn hình!',
            ]);
        }

        if (!Hash::check($request->password, $customer->password)) {
            // Nếu mật khẩu không đúng
            return back()->withErrors([
                'password' => 'Vui lòng kiểm tra lại mật khẩu của bạn!',
            ]);
        }

        // Nếu đăng nhập thành công
        Auth::login($customer);
        // Lấy ID của người dùng đã đăng nhập
        $userId = Auth::id();
        return $userId;
        return redirect()->intended('/demo')->with([
            'success' => 'Đăng nhập thành công!',
            'user_id' => $userId
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Bạn đã đăng xuất.');
    }
}
