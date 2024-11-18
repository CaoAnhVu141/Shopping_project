<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalProductController extends Controller
{
    // Viết hàm thống kê sản phẩm
    public function productStatistical()
    {
        $statistical = [
            'total_product' => Product::count(),
            'hot_product' => Product::where('hot', 1)->count(),
            'total_revenue' => Product::sum(DB::raw('price * number_of_purchases'))
        ];

        return response()->json([
            'message' => "Lấy dữ liệu thành công",
            'data' => $statistical
        ]);
    }

    // viết hàm gần hết sản phẩm
    public function outOfStockProduct()
    {
        $stockOfProduct = Product::where('quantity_available', '<', 10)
            ->get(['name', 'quantity_available']);
        return response()->json([
            'message' => "Lấy dữ liệu thành công",
            'data' => $stockOfProduct
        ], 200);
    }

    //thống kê 10 sản phẩm bán chạy nhất
    public function bestSellProduct()
    {
        $topProduct = OrderItem::join('product', 'order_item.id_product', '=', 'product.id_product') // Nối bảng product
            ->select(
                'order_item.id_order_item',
                'product.name', // Lấy tên sản phẩm
                DB::raw('SUM(order_item.quantity) as total_sold') // Tính tổng số lượng bán
            )
            ->groupBy('product.id_product', 'product.name','order_item.id_order_item')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get()
            ->makeHidden(['id_order_item']);

        return response()->json([
            'message' => "Lấy dữ liệu thành công",
            'data' => $topProduct,
        ], 200);
    }
}
