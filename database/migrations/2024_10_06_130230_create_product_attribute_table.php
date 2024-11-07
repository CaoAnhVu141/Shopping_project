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
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->bigIncrements('id_product_attribute');
            $table->unsignedBigInteger('id_attribute')->comment('thuộc tính');
            $table->unsignedBigInteger('id_product')->comment('sản phẩm');
            $table->unsignedBigInteger('id_attribute_value')->comment('giá trị thuộc tính');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute');
    }
};
