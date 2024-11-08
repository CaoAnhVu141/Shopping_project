<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostProductTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm một số mối quan hệ bài viết và sản phẩm
        DB::table('post_product')->insert([
            [
                'id_post' => 1, // ID của bài viết
                'id_product' => 1, // ID của sản phẩm
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_post' => 1,
                'id_product' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_post' => 2,
                'id_product' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_post' => 3,
                'id_product' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều bản ghi khác nếu cần
        ]);
    }
}
