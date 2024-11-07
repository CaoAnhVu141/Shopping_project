<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('order_item')->insert([
            [
                'id_order_item' => 1,
                'id_order' => 1,
                'id_product' => 1,
                'quantity' => 2,
                'price' => 200000,
                'status' => 'In Stock',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_order_item' => 2,
                'id_order' => 2,
                'id_product' => 2,
                'quantity' => 3,
                'price' => 300000,
                'status' => 'Out of Stock',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
