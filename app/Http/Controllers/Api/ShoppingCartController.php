<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    //
    // thêm vào giỏ hàng
    public function addToCartShopping(Request $request, $Idproduct)
    {
        // thực thi trả về id_session và id_customer
        $id_session = session()->getId();
        $id_customer = auth()->check() ? auth()->id() :null;

        // thực thi kiểm tra sản phẩm
        $product = Product::find($Idproduct);
        if(!$product)
        {
            return response()->json([
                'message' => 'Dữ liệu không tồn tại',
            ],404);
        }

        // tìm kiếm sản phẩm dựa trên trạng thái đăng nhập
        $itemsValues = null;
        if($id_customer)
        {
            // lấy trên id của khách hàng
            $itemsValues = ShoppingCart::where('id_product',$Idproduct)
                                        ->where('id_customer',$id_customer)
                                        ->first();
        }
        else{
            // lấy id session
            $itemsValues = ShoppingCart::where('id_product',$Idproduct)
                                        ->where('id_session',$id_session)
                                        ->first();
        }
        // thực thi kiểm tra và cập nhật giỏ hàng
        if($itemsValues)
        {
            $itemsValues->quantity +=1;
            $itemsValues->total_price = $itemsValues->quantity * $itemsValues->price;
            $itemsValues->save();
        }
        else{
            // Nếu sản phẩm chưa có, thêm sản phẩm mới vào giỏ hàng
        ShoppingCart::create([
            'id_customer' => $id_customer,
            'id_product' => $Idproduct,
            'id_session' => $id_session,
            'quantity' => 1,
            'price' => $product->price,
            'total_price' => $product->price * 1,
        ]);
        }
        return response()->json([
            'message' => "Đã thêm dữ liệu thành công",
        ],200);
    }
}
