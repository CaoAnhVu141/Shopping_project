<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('order')->insert([
            [
                'id_order' => 1,
                'id_customer' => 1,
                'id_shipping_method' => 1,
                'id_payment' => 1,
                'total_item' => 500000,
                'status' => 'Pending',
                'shipping_address' => '123 Đường ABC, TP. Hồ Chí Minh',
                'order_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order' => 2,
                'id_customer' => 2,
                'id_shipping_method' => 2,
                'id_payment' => 2,
                'total_item' => 800000,
                'status' => 'Completed',
                'shipping_address' => '456 Đường DEF, Hà Nội',
                'order_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
