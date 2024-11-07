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
        Schema::create('order_item_attribute', function (Blueprint $table) {
            $table->bigIncrements('id_oder_item_attribute');
            $table->unsignedBigInteger('id_order_item');
            $table->unsignedBigInteger('id_attribute');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_attribute');
    }
};
