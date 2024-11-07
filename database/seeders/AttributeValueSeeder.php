<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('attribute_value')->insert([
            ['id_attribute' => 1, 'value' => 'Red', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_attribute' => 1, 'value' => 'Blue', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_attribute' => 1, 'value' => 'Green', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_attribute' => 2, 'value' => 'S', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_attribute' => 2, 'value' => 'M', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id_attribute' => 2, 'value' => 'L', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
