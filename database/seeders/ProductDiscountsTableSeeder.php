<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDiscountsTableSeeder extends Seeder
{
    public function run()
    {
        // Giả sử bạn đã có một số sản phẩm và mã giảm giá trong cơ sở dữ liệu

        DB::table('product_discount')->insert([
            [
                'id_product' => 1, // ID của sản phẩm đầu tiên
                'id_discount' => 1, // ID của mã giảm giá đầu tiên
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 2,
                'id_discount' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_product' => 3,
                'id_discount' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều bản ghi khác nếu cần
        ]);
    }
}
