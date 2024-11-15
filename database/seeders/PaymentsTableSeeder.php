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
                'payment_method' => 'Tiền mặt',
                'describe' => 'Thanh toán bằng thẻ tín dụng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_method' => 'Ví điện tử VN PAY',
                'describe' => 'Thanh toán qua VN PAY',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

