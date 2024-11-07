<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayMonneyViewController extends Controller
{
    //
    public function showViewPayMoney()
    {
        return view('Front-end-Shopping.paymoney');
    }
}
