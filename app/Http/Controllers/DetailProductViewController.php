<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DetailProductViewController extends Controller
{
    //
    // hiển thị giao diện chi tiết sản phẩm và mã hoá lại id+product
    public function showViewProductDetail($id_slug)
    {
        list($id_product, $slug) = explode('_', $id_slug, 2);
        $product = Product::findOrFail($id_product);
        // thực hiện tạo slug
        $expectedSlug = Str::slug($product->name);
        // dd($expectedSlug);
        if($slug !== $expectedSlug)
        {
            abort(404);
        }
        return view('Front-end-Shopping.product_detail', compact('product'));
    }
}
