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
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id_order');
            $table->unsignedBigInteger('id_customer')->nullable();
            $table->unsignedBigInteger('id_shipping_method');
            $table->unsignedBigInteger('id_payment');
            $table->decimal('total_item',20,2)->comment('Tổng tiền');
            $table->string('status')->default('Đã tiếp nhận')->comment('Trạng thái đơn hàng');
            $table->string('shipping_address')->comment('Địa chỉ giao hàng');
            $table->dateTime('order_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
