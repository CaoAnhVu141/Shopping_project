<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // GET /api/favorites - Lấy danh sách yêu thích
    // Lấy danh sách sản phẩm yêu thích của người dùng
    public function index($customerId)
    {
        $favorites = Favorite::where('id_customer', $customerId)
            ->with('product')
            ->get();

        return response()->json($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    // POST /api/favorites - Thêm sản phẩm vào danh sách yêu thích
    // Thêm sản phẩm vào danh sách yêu thích
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_customer' => 'required|exists:customers,id_customer',
            'id_product' => 'required|exists:products,id_product',
        ]);

        // Kiểm tra xem sản phẩm có bị xóa không
        $product = Product::find($validated['id_product']);
        if (!$product) {
            return response()->json(['error' => 'Sản phẩm bạn muốn thêm không còn tồn tại.'], 404);
        }

        $favorite = Favorite::create($validated);
        return response()->json($favorite, 201);
    }

    /**
     * Display the specified resource.
     */
    // GET /api/favorites/{id} - Lấy thông tin một mục yêu thích
    // Xem chi tiết sản phẩm yêu thích
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // DELETE /api/favorites/{id} - Xóa mục yêu thích
    // Xóa sản phẩm yêu thích
    public function destroy($customerId, $favoriteId)
    {
        $favorite = Favorite::where('id_customer', $customerId)
            ->where('id_favorite', $favoriteId)
            ->lockForUpdate()
            ->first();

        if (!$favorite) {
            return response()->json(['error' => 'Không tìm thấy sản phẩm để xóa.'], 404);
        }

        DB::transaction(function () use ($favorite) {
            $favorite->delete();
        });

        return response()->json(['message' => 'Sản phẩm đã được xóa khỏi danh sách yêu thích.'], 200);
    }
}

