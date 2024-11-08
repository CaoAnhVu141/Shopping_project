<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng category dành cho shop quần áo
        DB::table('category')->insert([
            [
                'name' => 'Men\'s Clothing',
                'describe' => 'Clothing for men including shirts, pants, and jackets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Women\'s Clothing',
                'describe' => 'Clothing for women including dresses, skirts, and blouses',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kids\' Clothing',
                'describe' => 'Clothing for kids including T-shirts, shorts, and jackets',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Accessories',
                'describe' => 'Various accessories like belts, hats, and scarves',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
