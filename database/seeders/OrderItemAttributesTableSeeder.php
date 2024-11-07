<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemAttributesTableSeeder extends Seeder
{
    public function run()
    {
        // Giả sử bạn đã có một số bản ghi trong bảng order_item và attribute

        DB::table('order_item_attribute')->insert([
            [
                'id_order_item' => 1, // ID của order_item đầu tiên
                'id_attribute' => 1,   // ID của attribute đầu tiên
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order_item' => 1,
                'id_attribute' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order_item' => 2,
                'id_attribute' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order_item' => 2,
                'id_attribute' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều bản ghi khác nếu cần
        ]);
    }
}
