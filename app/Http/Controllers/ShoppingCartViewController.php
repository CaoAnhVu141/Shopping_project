<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartViewController extends Controller
{
    // test giao diện lại để demo
    public function showViewModelCart($id)
    {
        $items = Product::findOrFail($id);
        return view('Front-end-Shopping.model_shopping_cart',compact('items'));
    }

    public function showDemoNha()
    {
        $product = Product::paginate(3);
        return view('Front-end-Shopping.demo',compact('product'));
    }


}
