<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        // Thêm khách hàng vào bảng customers
        DB::table('customers')->insert([
            [
                'name' => 'Van Thuan',
                'email' => 'thuandang021102@gmail.com',
                'password' => Hash::make('0123456789@Tt1'),
                'phone' => '1234567890',
                'address' => '123 Street, City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('password123'),
                'phone' => '0987654321',
                'address' => '456 Avenue, City',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
