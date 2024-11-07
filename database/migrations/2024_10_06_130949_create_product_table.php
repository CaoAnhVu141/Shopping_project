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
            $table->Increments('product_id');
            $table->string('product_name');
            $table->integer('category_id');
            $table->text('product_desc');
            $table->text('product_content');
            $table->string('product_price');
            $table->string('product_image');
            $table->boolean('hot')->default(0); // 0 = không hot, 1 = hot
            $table->integer('sale')->default(0); // giá trị % giảm giá
            $table->integer('product_quantity')->default(0); // số lượng sản phẩm
            $table->integer('product_status');
            // $table->integer('discounted_price')->default(0); // Giá sau khi giảm
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
