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
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id_product');
            $table->unsignedBigInteger('id_category');
            $table->string('name');
            $table->text('describe')->comment('mô tả sản phẩm');
            $table->decimal('price',10,2);
            $table->string('images');
            $table->boolean('hot')->default(false)->comment('sản phẩm hot');
            $table->boolean('is_active')->default(true)->comment('còn hàng không');
            $table->boolean('sale')->default(false)->comment('có sale không');
            $table->bigInteger('number_of_purchases')->comment('số lượt mua');
            $table->bigInteger('quantity_available')->comment('số lượng còn lại');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
