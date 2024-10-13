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
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_shipping_method');
            $table->unsignedBigInteger('id_payment');
            $table->decimal('total_item')->comment('tổng tiền');
            $table->string('status')->default('đã tiếp nhận')->comment('trạng thái đơn hàng');
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