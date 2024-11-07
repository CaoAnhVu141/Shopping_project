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
        Schema::create('shipping_method', function (Blueprint $table) {
            $table->bigIncrements('id_shipping_method');
            $table->string('method_name')->comment("Tên phương thức vận chuyển");
            $table->decimal('cost',10,2);
            $table->string('estimated_time')->comment('Thời gian ước tính');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_method');
    }
};
