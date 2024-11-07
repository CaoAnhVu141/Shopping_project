<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        // Giả sử bạn đã có một số khách hàng, phương thức vận chuyển và phương thức thanh toán trong cơ sở dữ liệu

        DB::table('order')->insert([
            [
                'id_customer' => 1,
                'id_shipping_method' => 1,
                'id_payment' => 1,
                'total_item' => 250000,
                'status' => 'đã tiếp nhận',
                'shipping_address' => '123 Đường ABC, Quận 1, TP.HCM',
                'order_date' => now(),
            ],
            [
                'id_customer' => 2,
                'id_shipping_method' => 2,
                'id_payment' => 2,
                'total_item' => 150000,
                'status' => 'đã giao hàng',
                'shipping_address' => '456 Đường DEF, Quận 2, TP.HCM',
                'order_date' => now(),
            ],
            // Thêm nhiều đơn hàng khác nếu cần
        ]);
    }
}
