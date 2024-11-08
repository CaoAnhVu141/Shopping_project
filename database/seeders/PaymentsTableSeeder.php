<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng payments
        DB::table('payments')->insert([
            [
                'payment_method' => 'Credit Card',
                'describe' => 'Thanh toán bằng thẻ tín dụng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method' => 'PayPal',
                'describe' => 'Thanh toán qua PayPal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method' => 'Cash on Delivery',
                'describe' => 'Thanh toán khi nhận hàng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

