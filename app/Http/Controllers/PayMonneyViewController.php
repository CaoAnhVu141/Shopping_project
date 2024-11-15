<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class PayMonneyViewController extends Controller
{
    //
    public function showViewPayMoney()
    {
        $payment = Payment::get();
        $shipping = ShippingMethod::get();
        return view('Front-end-Shopping.paymoney',compact('payment','shipping'));
        // return view('Front-end-Shopping.paymoney');

    }
}
