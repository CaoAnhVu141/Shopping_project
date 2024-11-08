<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingMethodTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng shipping_method
        DB::table('shipping_method')->insert([
            [
                'method_name' => 'Giao hàng tiêu chuẩn',
                'cost' => 50000.00,
                'estimated_time' => '3-5 ngày làm việc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'method_name' => 'Giao hàng nhanh',
                'cost' => 100000.00,
                'estimated_time' => '1-2 ngày làm việc',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'method_name' => 'Giao hàng siêu tốc',
                'cost' => 150000.00,
                'estimated_time' => 'Trong ngày',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
