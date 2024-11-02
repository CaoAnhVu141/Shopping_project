<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetViewAllItemsShoppingCart extends Controller
{
    // viết phương thức trả về view giỏ hàng
    public function showAllItemsShoppingCart(Request $request)
    {
       return view("Front-end-Shopping.shopping_cart");
    }
}
