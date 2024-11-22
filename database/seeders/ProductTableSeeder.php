<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('product')->insert([
            [
                'id_category' => 1,
                'name' => 'Túi xách đen',
                'describe' => 'Túi xách đen dày 2 quai',
                'price' => 200000,
                'images' => '1.jpg',
                'category_status' => 1, // Thêm giá trị category_status
                'product_status' => 1,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 50,
                'quantity_available' => 100,
            ],
            [
                'id_category' => 1,
                'name' => 'Ví màu hồng',
                'describe' => 'Ví màu hồng, thời trang cao cấp',
                'price' => 300000,
                'images' => '2.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 0,
                'number_of_purchases' => 30,
                'quantity_available' => 80,
            ],
            [
                'id_category' => 2,
                'name' => 'Giày nike thể thao',
                'describe' => 'Giày nike thể thao, chất liệu giày co giãn',
                'price' => 150000,
                'images' => '3.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 1,
                'name' => 'Ví tiền nam màu đen',
                'describe' => 'Ví tiền nam màu đen, có phần giấu quỹ đen',
                'price' => 150000,
                'images' => '3.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 2,
                'name' => 'Giày hồng Oxford',
                'describe' => 'Giày mang giá trị của người không có tiền',
                'price' => 150000,
                'images' => '5.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 2,
                'name' => 'Giày trắng du lịch',
                'describe' => 'Giày mang đi chơi',
                'price' => 150000,
                'images' => '6.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 2,
                'name' => 'Giày đen Oxford',
                'describe' => 'Giày mang giá trị của người không có tiền',
                'price' => 150000,
                'images' => '9.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 2,
                'name' => 'Giày thể thao nâu đen NIKE',
                'describe' => 'Giày mang đi chơi pickeball',
                'price' => 150000,
                'images' => '10.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 5,
                'name' => 'Ví đựng đồng xu',
                'describe' => 'Sành điều sang trọng của ví đựng đồng xu',
                'price' => 150000,
                'images' => '11.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 4,
                'name' => 'Áo gấu bông màu nâu',
                'describe' => 'Áo gấu bông màu nâu',
                'price' => 150000,
                'images' => '12.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 4,
                'name' => 'Áo gấu bông màu trắng',
                'describe' => 'Áo gấu bông màu trắng',
                'price' => 150000,
                'images' => '13.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 3,
                'name' => 'Đồ bộ áo thể thao đen trắng mặc cực cool',
                'describe' => 'Đồ bộ áo thể thao mặc cực cool',
                'price' => 150000,
                'images' => '14.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
            [
                'id_category' => 3,
                'name' => 'Đồ bộ áo thể thao áo trắng quần đen mặc cực cool',
                'describe' => 'Đồ bộ áo thể thao mặc cực cool',
                'price' => 150000,
                'images' => '15.jpg',
                'category_status' => 0, // Thêm giá trị category_status
                'product_status' => 0,
                'hot' => 1,
                'is_active' => 1,
                'sale' => 1,
                'number_of_purchases' => 40,
                'quantity_available' => 90,
            ],
        ]);
    }
}
