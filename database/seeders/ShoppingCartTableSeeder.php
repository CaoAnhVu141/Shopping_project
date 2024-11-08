<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingCartTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm một số sản phẩm vào giỏ hàng
        DB::table('shopping_cart')->insert([
            [
                'id_customer' => 1, // ID của khách hàng đã đăng nhập
                'id_product' => 1, // ID của sản phẩm
                'id_session' => null, // null nếu khách hàng đã đăng nhập
                'quantity' => 2, // Số lượng sản phẩm
                'price' => 29.99, // Giá của sản phẩm
                'total_price' => 59.98, // Tổng tiền
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => null, // null nếu chưa đăng nhập
                'id_product' => 2, // ID của sản phẩm
                'id_session' => 'abc123', // ID session cho khách chưa đăng nhập
                'quantity' => 1,
                'price' => 49.99,
                'total_price' => 49.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 1,
                'id_product' => 3,
                'id_session' => null,
                'quantity' => 3,
                'price' => 19.99,
                'total_price' => 59.97,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều bản ghi khác nếu cần
        ]);
    }
}
