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

    // test giao diện demo
    public function showDemoNha()
    {
        $product = Product::paginate(3);
        return view('Front-end-Shopping.demo',compact('product'));
    }

    // hiển thị giao diện chi tiết sản phẩm
    public function showViewProductDetail($id_product)
    {
        $product = Product::find($id_product);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return view('Front-end-Shopping.product_detail',compact('product'));
    }
}
