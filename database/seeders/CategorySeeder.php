<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('category')->insert([
            ['name' => 'T-Shirt', 'describe' => 'Áo thun', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Jeans', 'describe' => 'Quần Jeans', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Jackets', 'describe' => 'Áo khoác', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Shoes', 'describe' => 'Giày dép', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
