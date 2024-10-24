<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        // Tìm khách hàng
        $customer = Customer::where('email', $email)->first();

        if ($customer) {
            // Kiểm tra mã xác thực và thời gian hết hạn
            if ($customer->verification_token === $token && $customer->verification_token_expires_at > now()) {
                // Xác thực thành công
                $customer->email_verified_at = now();
                $customer->save();

                return redirect()->route('home')->with('success', 'Email đã được xác thực thành công!');
            }
        }

        return redirect()->route('register')->with('error', 'Xác thực thất bại hoặc liên kết đã hết hạn!');
    }
}
