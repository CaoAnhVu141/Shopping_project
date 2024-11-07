<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm 30 sản phẩm vào bảng product
        $products = [];

        for ($i = 1; $i <= 5; $i++) {
            $products[] = [
                'id_category' => rand(1, 5), // Giả sử có 4 danh mục sản phẩm
                'name' => 'Sản phẩm ' . $i,
                'describe' => 'Mô tả cho sản phẩm ' . $i,
                'price' => rand(100000, 1000000), // Giá sản phẩm ngẫu nhiên từ 100.000 đến 1.000.000
                'images' => 'product-01.jpg', // Giả sử có các hình ảnh với tên như vậy
                'hot' => rand(0, 1) == 1, // Ngẫu nhiên có sản phẩm hot hay không
                'is_active' => rand(0, 1) == 1, // Ngẫu nhiên có còn hàng hay không
                'sale' => rand(0, 1) == 1, // Ngẫu nhiên có sale hay không
                'number_of_purchases' => rand(0, 100), // Số lượt mua ngẫu nhiên
                'quantity_available' => rand(0, 50), // Số lượng còn lại ngẫu nhiên
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('product')->insert($products);
    }
}
