<?php

namespace Database\Seeders;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Customer::create([
            'name' => 'Đỗ Tiến Đại',
            'email' => 'dotiendai789@gmail.com',
            'password' => bcrypt('password123'), // Mật khẩu đã được mã hóa
            'phone' => '0123456789',
            'address' => '123 Đường ABC, TP. Hồ Chí Minh',
            'token' => strtoupper(Str::random(10)), // Không có token khi tạo mới
        ]);

        Customer::create([
            'name' => 'Lê Hoàng Thịnh',
            'email' => 'le.hamthang21@gmail.com',
            'password' => bcrypt('password123'), // Mật khẩu đã được mã hóa
            'phone' => '0123456789',
            'address' => '123 Đường ABC, TP. Hồ Chí Minh',
            'token' => strtoupper(Str::random(10)), // Không có token khi tạo mới
        ]);

        Customer::create([
            'name' => 'Trần Anh Tuấn',
            'email' => 'anhtuan2551104@gmail.com',
            'password' => bcrypt('password123'), // Mật khẩu đã được mã hóa
            'phone' => '0123456789',
            'address' => '123 Đường ABC, TP. Hồ Chí Minh',
            'token' => strtoupper(Str::random(10)), // Không có token khi tạo mới
        ]);
        Customer::create([
            'name' => 'Tran Thi C',
            'email' => 'banphong1101@gmail.com',
            'password' => bcrypt('123456789@Phong'),
            'phone' => '0987654321',
            'address' => '456 Đường DEF, Hà Nội',
            'token' => strtoupper(Str::random(10)),

        //
        DB::table('customers')->insert([
            [
                'id_customer' => 1,
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'password' => Hash::make('password123'),
                'token' => Str::random(10),
                'phone' => '0901234567',
                'address' => '123 Đường Lê Lợi, Quận 1, TP.HCM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 2,
                'name' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'password' => Hash::make('password123'),
                'token' => Str::random(10),
                'phone' => '0912345678',
                'address' => '456 Đường Nguyễn Huệ, Quận 3, TP.HCM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 3,
                'name' => 'Phạm Văn C',
                'email' => 'phamvanc@example.com',
                'password' => Hash::make('password123'),
                'token' => Str::random(10),
                'phone' => '0923456789',
                'address' => '789 Đường Phạm Ngũ Lão, Quận 5, TP.HCM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 4,
                'name' => 'Lê Thị D',
                'email' => 'lethid@example.com',
                'password' => Hash::make('password123'),
                'token' => Str::random(10),
                'phone' => '0934567890',
                'address' => '321 Đường Lê Lai, Quận 10, TP.HCM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_customer' => 5,
                'name' => 'Hoàng Văn E',
                'email' => 'hoangvane@example.com',
                'password' => Hash::make('password123'),
                'token' => Str::random(10),
                'phone' => '0945678901',
                'address' => '654 Đường Hùng Vương, Quận 7, TP.HCM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
