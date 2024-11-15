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
        Schema::create('shopping_cart', function (Blueprint $table) {
            $table->bigIncrements('id_shopping_cart');
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->unsignedBigInteger('id_product');
            $table->bigInteger('quantity')->comment("Số lượng");
            $table->string('id_session')->nullable()->comment('id khi không đăng nhập');
            $table->decimal('price', 20, 2);
            $table->decimal('total_price', 20, 2)->comment('Tổng tiền');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart');
    }
};
