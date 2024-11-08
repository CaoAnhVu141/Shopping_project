<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng product_attribute
        DB::table('product_attribute')->insert([
            [
                'id_attribute' => 1, // Giả sử id 1 là thuộc tính "Màu sắc"
                'id_product' => 1, // Giả sử id 1 là sản phẩm đầu tiên
                'id_attribute_value' => 1, // Giá trị thuộc tính "Đỏ"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 1,
                'id_product' => 1,
                'id_attribute_value' => 2, // Giá trị thuộc tính "Xanh"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 2, // Giả sử id 2 là thuộc tính "Kích thước"
                'id_product' => 2, // Giả sử id 2 là sản phẩm thứ hai
                'id_attribute_value' => 3, // Giá trị thuộc tính "S"
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_attribute' => 2,
                'id_product' => 2,
                'id_attribute_value' => 4, // Giá trị thuộc tính "M"
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
