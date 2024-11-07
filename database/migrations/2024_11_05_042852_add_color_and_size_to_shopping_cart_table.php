<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('shopping_cart', function (Blueprint $table) {
            //
            $table->string('color', 50)->nullable()->after('total_price'); // Thêm cột màu sắc
            $table->string('size', 10)->nullable()->after('color'); // Thêm cột kích thước
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shopping_cart', function (Blueprint $table) {
            //
        });
    }
};
