<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng discount
        DB::table('discount')->insert([
            [
                'code' => 'SUMMER2024',
                'describe' => 'Giảm giá 20% cho tất cả các sản phẩm mùa hè',
                'start_day' => '2024-06-01 00:00:00',
                'end_day' => '2024-06-30 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'WINTER2024',
                'describe' => 'Giảm giá 30% cho các sản phẩm mùa đông',
                'start_day' => '2024-12-01 00:00:00',
                'end_day' => '2024-12-31 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
