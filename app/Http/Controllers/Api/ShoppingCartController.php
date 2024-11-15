<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;



class ShoppingCartController extends Controller
{
     //@thêm sản phẩm vào giỏ hàng
    public function addToCartShopping(Request $request, $Idproduct)
    {
        // Lấy `session_id` từ yêu cầu hoặc từ session hiện tại
        $id_session = $request->input('session_id') ?? Session::getId();
        $id_customer = auth()->check() ? auth()->id() : null;

        // Kiểm tra sản phẩm tồn tại
        $product = Product::find($Idproduct);
        if (!$product) {
            return response()->json(['message' => 'Dữ liệu không tồn tại'], 404);
        }

        // Kiểm tra số lượng yêu cầu có hợp lệ không
        $quantity = $request->input('quantity', 1);
        if ($quantity <= 0 || $quantity > $product->quantity_available) {
            return response()->json(['message' => 'Xin lỗi, số lượng trong kho hàng không đủ'], 400);
        }
        // Lấy thêm thuộc tính `color` và `size`
        $color = $request->input('color');
        $size = $request->input('size');

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của session hoặc khách hàng này chưa
        $cartItem = ShoppingCart::where('id_product', $Idproduct)
            ->where(function ($query) use ($id_session, $id_customer) {
                $query->where('id_session', $id_session);
                if ($id_customer) {
                    $query->orWhere('id_customer', $id_customer);
                }
            })->first();
        // Cập nhật nếu sản phẩm đã có trong giỏ hàng, hoặc thêm mới nếu chưa có
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->total_price = $cartItem->quantity * $cartItem->price;
            $cartItem->color = $color;
            $cartItem->size = $size;
            $cartItem->save();
        } else {
            ShoppingCart::create([
                'id_customer' => $id_customer,
                'id_product' => $Idproduct,
                'id_session' => $id_session,
                'quantity' => $quantity,
                'price' => $product->price,
                'total_price' => $product->price * $quantity,
                'color' => $color,
                'size' => $size,
            ]);
        }

        return response()->json(['message' => "Đã thêm dữ liệu thành công"], 200);
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
        $quantity = max(1, (int) $request->quantity);
        if (auth()->check()) {
            $id_customer = auth()->id();
            $cartItem = ShoppingCart::where('id_customer', $id_customer)
                ->where('id_product', $request->id_product)
                ->first();
        } else {
            $id_session = Session::getId();
            $cartItem = ShoppingCart::where('id_session', $id_session)
                ->where('id_product', $request->id_product)
                ->first();
        }

        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->total_price = $quantity * $cartItem->price;
            $cartItem->save();
            return response()->json([
                'success' => true,
                'data' => $cartItem,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => "Không có sản phẩm nào",
        ], 404);
    }

    // thực hiện xoá sản phẩm trong giỏ hàng
    public function deleteItemsShoppingCart(Request $request, $id_product)
    {
        $cartItems = null;
        if (auth()->check()) {
            $id_customer = auth()->id();
            $cartItems = ShoppingCart::where('id_customer', $id_customer)
                ->where('id_product', $id_product)
                ->first();
        } else {
            $id_session = session()->getId();
            $cartItems = ShoppingCart::where('id_session', $id_session)
                ->where('id_product', $id_product)
                ->first();
        }
        if ($cartItems) {
            $cartItems->delete();
            return response()->json(['success' => true, 'message' => 'Sản phẩm đã được xoá khỏi giỏ hàng']);
        }
        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại trong giỏ hàng']);
    }
}
