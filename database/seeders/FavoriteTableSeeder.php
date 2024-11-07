<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng favorite
        DB::table('favorite')->insert([
            [
                'id_customer' => 1, // Giả sử khách hàng đầu tiên
                'id_product' => 1, // Giả sử sản phẩm đầu tiên
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 1,
                'id_product' => 2, // Giả sử sản phẩm thứ hai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 2, // Giả sử khách hàng thứ hai
                'id_product' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 2,
                'id_product' => 3, // Giả sử sản phẩm thứ ba
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
