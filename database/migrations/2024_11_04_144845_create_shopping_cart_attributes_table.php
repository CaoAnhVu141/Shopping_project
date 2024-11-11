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
        Schema::create('shopping_cart_attributes', function (Blueprint $table) {
            $table->bigIncrements('id_shopping_cart_attributes');
            $table->unsignedBigInteger('id_shopping_cart')->comment("shopping_cart");
            $table->unsignedBigInteger('id_attribute')->comment('attribute');
            $table->unsignedBigInteger('id_attribute_value')->comment('id_attribute_value')->comment('attribute_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_attributes');
    }
};
