<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        return view('Front-end-Shopping.favorite_product'); // Trả về view danh sách yêu thích
    }

    public function show($customerId, $favoriteId)
    {
        $favorite = Favorite::where('id_customer', $customerId)->findOrFail($favoriteId);
        return view('favorites.show', compact('favorite')); // Trả về view chi tiết sản phẩm yêu thích
    }
}
