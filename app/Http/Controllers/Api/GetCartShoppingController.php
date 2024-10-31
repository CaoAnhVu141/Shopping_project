<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;

class GetCartShoppingController extends Controller
{
    //lấy sản phẩm trong giỏ hàng
    // public function getItemsCartShopping(Request $request)
    // {
    //     // lấy id session
    //     $id_session = session()->getId();
    //     // lấy id_customer
    //     $id_customer = auth()->check() ? auth()->id() : null;

    //     $cartItems = ShoppingCart::with('product')->where(function($query) use ($id_session,$id_customer){
    //         $query->where('id_session',$id_session);

    //         if($id_customer)
    //         {
    //             $query->where('id_customer',$id_customer);
    //         }
    //     })->get();
    //     return response()->json($cartItems);
    // }

    public function getItemsCartShopping(Request $request)
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
