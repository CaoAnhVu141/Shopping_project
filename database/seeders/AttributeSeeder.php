<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('attribute')->insert([
            ['name' => 'Kích thước', 'describe' => 'Kích thước của sản phẩm'],
            ['name' => 'Màu sắc' , 'describe' => 'Màu sắc của sản phẩm']
        ]);
    }
}
