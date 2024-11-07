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
    Schema::table('product', function (Blueprint $table) {
        $table->integer('discounted_price')->default(0)->after('product_price');
    });
}

public function down(): void
{
    Schema::table('product', function (Blueprint $table) {
        $table->dropColumn('discounted_price');
    });
}

};
