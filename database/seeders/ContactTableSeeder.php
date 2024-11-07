<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng contact
        DB::table('contact')->insert([
            [
                'id_customer' => 1, // Chỉ định id của khách hàng đã có
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '1234567890',
                'message' => 'Tôi muốn biết thêm về sản phẩm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 2, // Chỉ định id của khách hàng đã có
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '0987654321',
                'message' => 'Tôi gặp vấn đề khi thanh toán đơn hàng.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
