<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetCartShoppingViewController extends Controller
{
    // thực thi show giao diện cho trang giỏ hàng  ở phần mater-layout chung
    public function showGetCartShopping()
    {
        return view("Front-end-Shopping.get_cart");
    }
}
