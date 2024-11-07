<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use function Laravel\Prompts\error;

// class ProductController extends Controller
// {
//     //
//     // lấy sản phẩm theo id dưới json
//     public function getItemsProduct($id_product)
//     {
//         $product = Product::findOrFail($id_product);
//         if(!$product)
//         {
//            return response()->json([
//                 'message' => "Giá trị không tồn tại",
//            ],404);
//         }
//         return response()->json([
//             'message' => "Giá trị hợp lệ",
//             'data' => $product,
//         ],200);
//     }

class ProductController extends Controller
{
    public function getAllProducts()
{
    $products = DB::table('tbl_product')->paginate(5);
        
    return response()->json($products);
}
public function toggleStatus(Request $request, $id)
{
    $product = DB::table('tbl_product')::find($id);
    $product->product_status = $request->status;
    $product->save();

    return response()->json(['message' => 'Trạng thái sản phẩm đã được cập nhật!']);
}

public function delete($id)
{
    DB::table('tbl_product')::destroy($id);
    return response()->json(['message' => 'Sản phẩm đã được xóa!']);
}


}
