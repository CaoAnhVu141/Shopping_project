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
        Schema::create('post_product', function (Blueprint $table) {
            $table->bigIncrements('id_post_product');
            $table->unsignedBigInteger('id_post')->comment('id bài viết');
            $table->unsignedBigInteger('id_product')->comment('id sản phẩm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_product');
    }
};
