<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusHistoryTableSeeder extends Seeder
{
    public function run()
    {
        // Giả sử bạn đã có một số bản ghi trong bảng orders
        DB::table('order_status_history')->insert([
            [
                'id_order' => 1, // ID của đơn hàng đầu tiên
                'status' => 'đã tiếp nhận', // Trạng thái đơn hàng
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 1,
                'status' => 'đang xử lý',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2,
                'status' => 'đã giao hàng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2,
                'status' => 'đã hoàn thành',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều bản ghi khác nếu cần
        ]);
    }
}
