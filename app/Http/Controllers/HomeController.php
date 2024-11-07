<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // lay danh muc
        $categories = Category::all();

        //lay san pham
        $products = Product::paginate(8);

        return view('Front-end-Shopping.shopping-index.shopping_index', compact('products', 'categories'));
    }
  
    public function filter(Request $request)
    {
        $categoryId = $request->input('category_id');

        if ($categoryId == 0) {
            $products = Product::paginate(8);
        } else {

            $products = Product::where('id_category', $categoryId)->paginate(8);
        }

        return response()->json($products);
    }

    public function loadMore(Request $request)
    {
        $categoryId = $request->input('category_id');
        $page = $request->input('page', 1); // Lấy trang hiện tại, mặc định là 1

        // Nếu không có categoryId, lấy tất cả sản phẩm
        if ($categoryId == 0) {
            $products = Product::paginate(8, ['*'], 'page', $page);
        } else {
            $products = Product::where('id_category', $categoryId)->paginate(8, ['*'], 'page', $page);
        }

        return response()->json($products);
    }
}
