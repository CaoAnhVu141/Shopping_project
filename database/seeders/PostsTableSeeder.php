<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng posts
        DB::table('posts')->insert([
            [
                'name' => 'Summer Fashion Trends',
                'describe' => 'A look at the top trends for summer 2024',
                'id_category_post' => 1, // Giả sử category_post với id 1 là Fashion Tips
                'content' => 'Here are the top fashion trends you need to know for summer 2024...',
                'image' => 'summer_fashion.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'How to Style a Blazer',
                'describe' => 'Tips on how to style a blazer for different occasions',
                'id_category_post' => 2, // Giả sử category_post với id 2 là Style Guides
                'content' => 'Blazers are a versatile wardrobe item. Here’s how to style them...',
                'image' => 'blazer_style.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Review: New Denim Jacket',
                'describe' => 'A detailed review of the new denim jacket from Brand X',
                'id_category_post' => 3, // Giả sử category_post với id 3 là Product Reviews
                'content' => 'This denim jacket is a must-have for your wardrobe. Here’s why...',
                'image' => 'denim_jacket.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
