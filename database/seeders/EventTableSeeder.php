<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng event
        DB::table('event')->insert([
            [
                'name' => 'Summer Sale',
                'content' => 'Giảm giá 50% cho tất cả các sản phẩm trong mùa hè.',
                'image' => 'summer_sale.jpg',
                'check_active' => true,
                'start_day' => '2024-07-01 00:00:00',
                'end_day' => '2024-07-31 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Winter Collection Launch',
                'content' => 'Ra mắt bộ sưu tập mùa đông với ưu đãi đặc biệt.',
                'image' => 'winter_collection.jpg',
                'check_active' => false,
                'start_day' => '2024-12-01 00:00:00',
                'end_day' => '2024-12-31 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
