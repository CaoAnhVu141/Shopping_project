<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuccessBuyItemsViewController extends Controller
{
    //
    public function showViewSuccessBuyItems()
    {
        return view("Front-end-Shopping.success_buy_items");
    }
}
