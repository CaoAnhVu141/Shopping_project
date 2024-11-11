<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\ShoppingCart;
use Attribute;
use Illuminate\Http\Request;

class PayMonneyController extends Controller
{
    //// thực hiện thực thi để thanh toán
    public function makePaymentAllItems(Request $request)
    {
        try {
            $cartItems = null;
            if (auth()->check()) {
                $id_customer = auth()->id();
                $cartItems = ShoppingCart::where('id_customer', $id_customer)
                    ->with('product')
                    ->get();
            } else {
                $id_session = session()->getId();
                $cartItems = ShoppingCart::where('id_session', $id_session)
                    ->with('product')
                    ->get();
            }

            // Kiểm tra nếu giỏ hàng trống
            if ($cartItems->isEmpty()) {
                return response()->json(['message' => 'Giỏ hàng của bạn trống'], 400);
            }

            // Định dạng lại dữ liệu giỏ hàng
                $cartItems = $cartItems->map(function ($item) {
                $sizeValue = $item->size ? AttributeValue::find($item->size)->value : null;
                $colorValue = $item->color  ? AttributeValue::find($item->color)->value : null;
                return [
                    'id_product' => $item->id_product,
                    'product_name' => $item->product->name, // Tên sản phẩm từ bảng `products`
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total_price' => $item->total_price,
                    'color' => $sizeValue,
                    'size' => $colorValue
                ];
            });

            return response()->json($cartItems, 200);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về thông báo lỗi
            return response()->json(['message' => 'Đã xảy ra lỗi trong quá trình thanh toán', 'error' => $e->getMessage()], 500);
        }
    }
}
