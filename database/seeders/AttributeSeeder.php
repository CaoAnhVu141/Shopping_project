<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('attribute')->insert([
            ['name' => 'Color', 'describe' => 'Màu sắc của sản phẩm', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Size', 'describe' => 'Kích thước sản phẩm', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
