<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostsTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng category_posts
        DB::table('category_posts')->insert([
            [
                'name' => 'Fashion Tips',
                'describe' => 'Latest fashion advice and trends',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Style Guides',
                'describe' => 'Guides on how to style different outfits',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product Reviews',
                'describe' => 'Reviews of the latest clothing items and accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
