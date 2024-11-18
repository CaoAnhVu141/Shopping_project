<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use mysqli;

class VnPayController extends Controller
{
    //copy chat GPT
    public function createPayment(Request $request)
    {
        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = config('vnpay.vnp_Url');
        $vnp_ReturnUrl = "https://47f3-113-161-132-172.ngrok-free.app/api/vnpay-return";

        $vnp_TxnRef = time() . rand(1000, 9999); // Mã giao dịch duy nhất
        $vnp_Amount = 200000 * 100; // Số tiền (VNĐ × 100)
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

        ksort($inputData); // Sắp xếp tham số theo thứ tự bảng chữ cái

        $hashdata = urldecode(http_build_query($inputData)); // Tạo chuỗi hash
        $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); // Tạo chữ ký bảo mật

        $query = http_build_query($inputData) . '&vnp_SecureHash=' . $vnp_SecureHash;
        $paymentUrl = $vnp_Url . "?" . $query;

        Log::info('VNPAY Debug', [
            'hashdata' => $hashdata,
            'generated_hash' => $vnp_SecureHash,
            'payment_url' => $paymentUrl,
        ]);

        return response()->json([
            'success' => true,
            'payment_url' => $paymentUrl,
        ]);
    }





    // public function createPayment(Request $request)
    // {
    //     $vnp_TmnCode = config('vnpay.vnp_TmnCode'); // Mã Terminal ID
    //     $vnp_HashSecret = config('vnpay.vnp_HashSecret'); // Chuỗi bí mật
    //     $vnp_Url = config('vnpay.vnp_Url'); // URL thanh toán
    //     $vnp_ReturnUrl = "https://47f3-113-161-132-172.ngrok-free.app/api/vnpay-return"; // URL trả về
    //     $vnp_TxnRef = time() . rand(1000, 9999); // Mã giao dịch duy nhất
    //     $vnp_Amount = 200000 * 100; // Số tiền (VNĐ × 100)
    //     $vnp_OrderInfo = urlencode("Thanh toan don hang $vnp_TxnRef");
    //     $vnp_Locale = "vn"; // Ngôn ngữ
    //     $vnp_IpAddr = $request->ip(); // IP khách hàng
    //     $vnp_CreateDate = date('YmdHis'); // Thời gian tạo giao dịch
    //     // Dữ liệu gửi đến VNPAY
    //     $inputData = [
    //         "vnp_Version" => "2.1.0",
    //         "vnp_Command" => "pay",
    //         "vnp_TmnCode" => $vnp_TmnCode,
    //         "vnp_Amount" => $vnp_Amount,
    //         "vnp_CurrCode" => "VND",
    //         "vnp_TxnRef" => $vnp_TxnRef,
    //         "vnp_OrderInfo" => $vnp_OrderInfo,
    //         "vnp_Locale" => $vnp_Locale,
    //         "vnp_ReturnUrl" => $vnp_ReturnUrl,
    //         "vnp_IpAddr" => $vnp_IpAddr,
    //         "vnp_CreateDate" => $vnp_CreateDate,
    //     ];

    //     // Sắp xếp tham số theo thứ tự bảng chữ cái
    //     ksort($inputData);
    //     $hashdata = urldecode(http_build_query($inputData));
    //     $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

    //     // Tạo URL thanh toán
    //     $query = http_build_query($inputData) . '&vnp_SecureHash=' . $vnp_SecureHash;
    //     $paymentUrl = $vnp_Url . "?" . $query;

    //     // Ghi log để kiểm tra
    //     Log::info('VNPAY Debug', [
    //         'vnp_Amount' => $vnp_Amount,
    //         'vnp_TxnRef' => $vnp_TxnRef,
    //         'vnp_CreateDate' => $vnp_CreateDate,
    //         'vnp_ReturnUrl' => $vnp_ReturnUrl,
    //         'hashdata' => $hashdata,
    //         'generated_hash' => $vnp_SecureHash,
    //         'payment_url' => $paymentUrl,
    //     ]);

    //     // Trả về URL thanh toán
    //     return response()->json([
    //         'success' => true,
    //         'payment_url' => $paymentUrl,
    //     ]);
    // }






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
            $hashData .= $key . '=' . $value . '&';
        }
        $hashData = rtrim($hashData, '&');
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
