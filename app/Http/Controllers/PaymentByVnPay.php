<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentByVnPay extends Controller
{
    //hàm trả giao diện khi thanh toán bằng vnpay
    public function showViewPayByVNPay()
    {
        $amount = 200000;
        return view('Front-end-Shopping.paymentbyvnpay',compact('amount'));
    }
}