<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('attribute_value')->insert([
            ['id_attribute' => 1, 'value' => 'S'],
            ['id_attribute' => 1, 'value' => 'M'],
            ['id_attribute' => 1, 'value' => 'L'],
        ]);
    }
}
