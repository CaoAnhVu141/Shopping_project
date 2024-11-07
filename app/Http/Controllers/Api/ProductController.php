<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
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
