<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsTableSeeder extends Seeder
{
    public function run()
    {
        // Giả sử bạn đã có một số đơn hàng và sản phẩm trong cơ sở dữ liệu

        DB::table('order_item')->insert([
            [
                'id_order' => 1, // ID của đơn hàng đầu tiên
                'id_product' => 1, // ID của sản phẩm đầu tiên
                'quantity' => 2,
                'price' => 125000,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 1,
                'id_product' => 2,
                'quantity' => 1,
                'price' => 150000,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2,
                'id_product' => 1,
                'quantity' => 1,
                'price' => 250000,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều mặt hàng khác nếu cần
        ]);
    }
}
