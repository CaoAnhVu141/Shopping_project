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
    // public function addToCartShopping(Request $request, $Idproduct)
    // {
    //     // thực thi trả về id_session và id_customer
    //     $id_session = session()->getId();
    //     $id_customer = auth()->check() ? auth()->id() : null;

    //     // thực thi kiểm tra sản phẩm
    //     $product = Product::find($Idproduct);
    //     if (!$product) {
    //         return response()->json([
    //             'message' => 'Dữ liệu không tồn tại',
    //         ], 404);
    //     }

    //     // tìm kiếm sản phẩm dựa trên trạng thái đăng nhập
    //     $itemsValues = null;
    //     $quantity = $request->input('quantity', 1);
    //     if ($id_customer) {
    //         // lấy trên id của khách hàng
    //         $itemsValues = ShoppingCart::where('id_product', $Idproduct)
    //             ->where('id_customer', $id_customer)
    //             ->first();
    //     } else {
    //         // lấy id session
    //         $itemsValues = ShoppingCart::where('id_product', $Idproduct)
    //             ->where('id_session', $id_session)
    //             ->first();
    //     }
    //     // thực thi kiểm tra và cập nhật giỏ hàng
    //     if ($itemsValues) {
    //         $itemsValues->quantity += 1;
    //         $itemsValues->total_price = $itemsValues->quantity * $itemsValues->price;
    //         $itemsValues->save();
    //     } else {
    //         // Nếu sản phẩm chưa có, thêm sản phẩm mới vào giỏ hàng
    //         ShoppingCart::create([
    //             'id_customer' => $id_customer,
    //             'id_product' => $Idproduct,
    //             'id_session' => $id_session,
    //             'quantity' => $quantity,
    //             'price' => $product->price,
    //             'total_price' => $product->price * $quantity,
    //         ]);
    //     }
    //     return response()->json([
    //         'message' => "Đã thêm dữ liệu thành công",
    //     ], 200);
    // }
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


    // Cập nhật lại số lượng đơn hàng
    public function updateItemsShoppingCart(Request $request, $id_product)
    {
        // Thực thi trả về id_session và id_customer
        $id_session = session()->getId();
        $id_customer = auth()->check() ? auth()->id() : null;

        // // Thực thi tìm sản phẩm trong giỏ hàng dựa trên id_customer hoặc id_session
        // $dataCartQuery = ShoppingCart::where('id_product', $id_product);
        // if ($id_customer) {
        //     $dataCartQuery->where('id_customer', $id_customer);
        // } else {
        //     $dataCartQuery->where('id_session', $id_session);
        // }
        // $dataCart = $dataCartQuery->first();
        // // Kiểm tra nếu sản phẩm không tồn tại trong giỏ hàng
        // if (!$dataCart) {
        //     return response()->json(['success' => false, 'message' => 'Dữ liệu không hợp lệ'], 404);
        // }
        // // Thực thi cập nhật số lượng và tính lại tổng giá
        // $dataCart->quantity = $request->input('quantity');
        // $dataCart->total_price = $dataCart->quantity * $dataCart->price;
        // $dataCart->save();

        // if (!$dataCart) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Dữ liệu không hợp lệ',
        //         'debug' => [
        //             'id_product' => $id_product,
        //             'id_customer' => $id_customer,
        //             'id_session' => $id_session,
        //         ]
        //     ], 404);
        // }
        // Truy vấn sản phẩm trong giỏ hàng
        $dataCartQuery = ShoppingCart::where('id_product', $id_product);

        if ($id_customer) {
            $dataCartQuery->where('id_customer', $id_customer);
        } else {
            $dataCartQuery->where('id_session', $id_session);
        }

        $dataCart = $dataCartQuery->first();
        dd($dataCart); // Kiểm tra kết quả truy vấn

        if (!$dataCart) {
            return response()->json(['success' => false, 'message' => 'Dữ liệu không hợp lệ'], 404);
        }
    }

}
