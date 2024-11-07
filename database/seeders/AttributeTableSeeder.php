<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng attribute
        DB::table('attribute')->insert([
            [
                'name' => 'Color',
                'describe' => 'Different colors available for products',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Size',
                'describe' => 'Sizes available for clothing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Material',
                'describe' => 'Type of material used in products',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
