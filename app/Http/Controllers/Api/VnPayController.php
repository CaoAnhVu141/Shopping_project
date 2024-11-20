<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VnPayController extends Controller
{
    //copy chat GPT
    public function createPayment(Request $request)
    {
        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = config('vnpay.vnp_Url');
        $vnp_ReturnUrl = config('vnpay.vnp_ReturnUrl');

        $vnp_TxnRef = time() . rand(1000, 9999); // Mã giao dịch duy nhất
        $vnp_Amount = 10000  * 100; // Số tiền (VNĐ × 100)
        $vnp_OrderInfo = "Giao dich thanh toan $vnp_TxnRef";
        $vnp_Locale = "vn";
        $vnp_IpAddr = $request->ip();
        if ($vnp_IpAddr === '127.0.0.1') {
            $vnp_IpAddr = '8.8.8.8'; // Dùng IP giả lập nếu localhost
        }
        $vnp_CreateDate = date('YmdHis');

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_Command" => "pay",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_CurrCode" => "VND",
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_Locale" => $vnp_Locale,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_CreateDate" => $vnp_CreateDate,
        ];

        ksort($inputData);

        $hashdata = '';
        foreach ($inputData as $key => $value) {
            $hashdata .= '&' . $key . '=' . $value;
        }
        $hashdata = ltrim($hashdata, '&');

        $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $query = http_build_query($inputData) . '&vnp_SecureHash=' . $vnp_SecureHash;
        $paymentUrl = $vnp_Url . "?" . $query;
        return response()->json([
            'success' => true,
            'payment_url' => $paymentUrl,
        ]);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $inputData = [];
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= '&' . $key . '=' . $value;
        }
        $hashData = ltrim($hashData, '&');
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                return response()->json([
                    'success' => true,
                    'message' => 'Thanh toán thành công',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Thanh toán thất bại',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
            ]);
        }
    }
}
