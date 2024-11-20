<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessPaymoneyViewController extends Controller
{
    //
    public function showViewSuccessPaymoney()
    {
        return view("Front-end-Shopping.success_buy_items");
    }
}
