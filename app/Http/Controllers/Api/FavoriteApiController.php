<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoriteApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($customerId)
    {
        $favorites = Favorite::where('id_customer', $customerId)
            ->with('product')
            ->paginate(3); // Số lượng mục mỗi trang

        return response()->json($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'id_customer' => 'required|exists:customers,id_customer',
            'id_product' => 'required|exists:products,id_product',
        ]);

        // Kiểm tra xem sản phẩm có bị xóa không
        $product = Product::find($validated['id_product']);
        if (!$product) {
            return response()->json(['error' => 'Sản phẩm bạn muốn thêm không còn tồn tại.'], 404);
        }

        // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
        $existingFavorite = Favorite::where('id_customer', $validated['id_customer'])
            ->where('id_product', $validated['id_product'])
            ->first();

        if ($existingFavorite) {
            return response()->json(['error' => 'Sản phẩm đã có trong danh sách yêu thích.'], 409);
        }

        $favorite = Favorite::create($validated);
        return response()->json($favorite, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($customerId, $favoriteId)
    {
        $favorite = Favorite::where('id_customer', $customerId)
            ->where('id_favorite', $favoriteId)
            ->with('product')
            ->first();

        if (!$favorite) {
            return response()->json(['error' => 'Không tìm thấy sản phẩm yêu thích.'], 404);
        }

        if (!$favorite->product) {
            return response()->json(['error' => 'Sản phẩm bạn muốn xem đã không còn bán ở shop.'], 404);
        }

        return response()->json($favorite);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($customerId, $favoriteId)
    {
        // Tìm sản phẩm yêu thích dựa trên customerId và favoriteId
        $favorite = Favorite::where('id_customer', $customerId)
            ->where('id_favorite', $favoriteId)
            ->first();

        if (!$favorite) {
            return response()->json(['error' => 'Không tìm thấy sản phẩm để xóa.'], 404);
        }

        // Xóa sản phẩm yêu thích
        $favorite->delete();

        return response()->json(['message' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích.'], 200);
    }
}
