<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentByVnPay extends Controller
{
    //hàm trả giao diện khi thanh toán bằng vnpay
    public function showViewPayByVNPay()
    {
        return view('Front-end-Shopping.paymentbyvnpay');
    }
}
