<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class GetAllItemsShoppingCart extends Controller
{
    //viết lấy danh sách giỏ hàng json
    // public function getAllItemsShoppingCart()
    // {
    //     $cartItems = null;
    //     if(auth()->check())
    //     {
    //         $userId = auth()->id();
    //         $cartItems = ShoppingCart::where('id_customer',$userId)
    //         ->with('product')->get();
    //     }
    //     else{
    //         $id_session = session()->getId();
    //         $cartItems = ShoppingCart::where('id_session',$id_session)->with('product')->get();
    //     }
    //     // kiểm tra nếu giỏ hàng rỗng
    //     if($cartItems->isEmpty())
    //     {
    //         return response()->json([
    //             'message' => "Giỏ hàng không có giá trị"
    //         ],404);
    //     }

    //     return response()->json([
    //         'message' => "Thành công",
    //         'data' => $cartItems
    //     ],200);


    // }

    public function getAllItemsShoppingCart()
    {
        $cartItems = null;
        if (auth()->check()) {
            // Nếu người dùng đã đăng nhập, lấy giỏ hàng theo `id_product`
            $userId = auth()->id();
            $cartItems = ShoppingCart::where('id_customer', $userId)
                ->with('product') // Lấy thêm thông tin sản phẩm từ bảng `products`
                ->get();
        } else {
            // Nếu chưa đăng nhập, lấy giỏ hàng theo `id_session`
            $id_session = session()->getId();
            $cartItems = ShoppingCart::where('id_session', $id_session)
                ->with('product') // Lấy thêm thông tin sản phẩm từ bảng `products`
                ->get();
        }
        // Chuyển đổi dữ liệu để dễ dàng hiển thị ở phía client
        $cartItems = $cartItems->map(function ($item) {
            return [
                'id_product' => $item->id_product,
                'product_name' => $item->product->name, // Tên sản phẩm từ bảng `products`
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total_price' => $item->total_price,
            ];
        });

        return response()->json($cartItems);
    }
}
