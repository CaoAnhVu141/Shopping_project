<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShoppingCartController extends Controller
{
    // thêm vào giỏ hàng
    public function addToCartShopping(Request $request, $Idproduct)
    {
        // Kiểm tra và lấy session_id từ yêu cầu frontend
        $id_session = $request->input('session_id') ?? session()->getId();
        $id_customer = auth()->check() ? auth()->id() : null;

        // Kiểm tra sản phẩm
        $product = Product::find($Idproduct);
        if (!$product) {
            return response()->json([
                'message' => 'Dữ liệu không tồn tại',
            ], 404);
        }

        $quantity = $request->input('quantity', 1);
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng của session này chưa
        $itemsValues = ShoppingCart::where('id_product', $Idproduct)
            ->where(function ($query) use ($id_session, $id_customer) {
                $query->where('id_session', $id_session);
                if ($id_customer) {
                    $query->orWhere('id_customer', $id_customer);
                }
            })
            ->first();
        // Cập nhật hoặc thêm mới sản phẩm vào giỏ hàng
        if ($itemsValues) {
            $itemsValues->quantity += $quantity;
            $itemsValues->total_price = $itemsValues->quantity * $itemsValues->price;
            $itemsValues->save();
        } else {
            ShoppingCart::create([
                'id_customer' => $id_customer,
                'id_product' => $Idproduct,
                'id_session' => $id_session,
                'quantity' => $quantity,
                'price' => $product->price,
                'total_price' => $product->price * $quantity,
            ]);
        }

        return response()->json([
            'message' => "Đã thêm dữ liệu thành công",
        ], 200);
    }

    //@Thực hiện cập nhật giỏ hàng ở trang giỏ hàng
    public function updateQuantityAllItems(Request $request)
    {
        if (!$request->has(['id_product', 'quantity'])) {
            return response()->json([
                'success' => false,
                'message' => 'Thiếu thông tin sản phẩm hoặc số lượng.'
            ], 400);
        }
        $quantity = max(1,(int) $request->quantity);
        if(auth()->check())
        {
            $id_customer = auth()->id();
            $cartItem = ShoppingCart::where('id_customer',$id_customer)
                        ->where('id_product',$request->id_product)
                        ->first();
        }
        else{
            $id_session = session()->getId();
            $cartItem = ShoppingCart::where('id_session',$id_session)
                        ->where('id_product',$request->id_product)
                        ->first();
        }

        if($cartItem)
        {
            $cartItem->quantity = $quantity;
            $cartItem->total_price = $quantity * $cartItem->price;
            $cartItem->save();

            return response()->json([
                'success' => true,
                'data' => $cartItem,
            ],200);
        }

        return response()->json([
            'success' => false,
            'message' => "Không có sản phẩm nào",
        ],404);
    }

    // thực hiện xoá sản phẩm trong giỏ hàng
    public function deleteItemsShoppingCart(Request $request, $id_product)
    {
        $cartItems = null;
        if(auth()->check())
        {
            $id_customer = auth()->id();
            $cartItems = ShoppingCart::where('id_customer',$id_customer)
                        ->where('id_product',$id_product)
                        ->first();
        }
        else{
            $id_session = session()->getId();
            $cartItems = ShoppingCart::where('id_session',$id_session)
                        ->where('id_product',$id_product)
                        ->first();
        }
        if($cartItems)
        {
            $cartItems->delete();
            return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xoá khỏi giỏ hàng']);
        }
        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng']);
    }
}


