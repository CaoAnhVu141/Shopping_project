<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartViewController extends Controller
{


    // test cái giao diện trang home
    public function showDemoNha()
    {
        $product = Product::paginate(10);
        return view('Front-end-Shopping.demo',compact('product'));
    }


}
