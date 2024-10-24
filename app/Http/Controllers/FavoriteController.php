<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function showFavorites()
    {
        $favorites = Auth::user()->favorites()->with('product')->get(); // Lấy danh sách sản phẩm yêu thích của người dùng

        return view('favorites.index', compact('favorites')); // Trả về view với danh sách sản phẩm yêu thích
    }

    // Các phương thức addToFavorites và removeFromFavorites ở đây...
}
