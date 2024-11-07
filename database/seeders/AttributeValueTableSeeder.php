<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValueTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng attribute_value
        DB::table('attribute_value')->insert([
            [
                'id_attribute' => 1, // Giả sử id 1 là thuộc tính "Màu sắc"
                'value' => 'Đỏ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 1, // Giả sử id 1 là thuộc tính "Màu sắc"
                'value' => 'Xanh lá',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 1, // Giả sử id 1 là thuộc tính "Màu sắc"
                'value' => 'Xanh dương',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 1, // Giả sử id 1 là thuộc tính "Màu sắc"
                'value' => 'Đen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 1, // Giả sử id 1 là thuộc tính "Màu sắc"
                'value' => 'Trắng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 1, // Giả sử id 1 là thuộc tính "Màu sắc"
                'value' => 'Hồng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 2, // Giả sử id 2 là thuộc tính "Kích thước"
                'value' => 'S',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 2, // Giả sử id 2 là thuộc tính "Kích thước"
                'value' => 'M',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 2, // Giả sử id 2 là thuộc tính "Kích thước"
                'value' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 2, // Giả sử id 2 là thuộc tính "Kích thước"
                'value' => 'XL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 2, // Giả sử id 2 là thuộc tính "Kích thước"
                'value' => 'XXL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
