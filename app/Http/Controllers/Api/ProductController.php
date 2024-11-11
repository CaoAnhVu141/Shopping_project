<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class ProductController extends Controller
{
    //
    // lấy sản phẩm theo id dưới json
    public function getItemsProduct($id_product)
    {
        $product = Product::findOrFail($id_product);
        if(!$product)
        {
           return response()->json([
                'message' => "Giá trị không tồn tại",
           ],404);
        }
        return response()->json([
            'message' => "Giá trị hợp lệ",
            'data' => $product,
        ],200);
    }
}
