<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
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
        // dd($slug); die();
        // dd($expectedSlug);
        if($slug !== $expectedSlug)
        {
            abort(404);
        }
        // thực thi lấy các thuộc tính attribute_value
        $sizeAttribute = Attribute::where('name', 'Kích thước')->first();
        $size = $sizeAttribute ? AttributeValue::where('id_attribute',$sizeAttribute->id_attribute)->get() : collect();
        $colorAttribute = Attribute::where('name','Màu sắc')->first();
        $color = $colorAttribute ? AttributeValue::where('id_attribute',$colorAttribute->id_attribute)->get() : collect();
        return view('Front-end-Shopping.product_detail', compact('product','size','color'));
    }
}
