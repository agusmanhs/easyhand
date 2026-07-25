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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('buyer_sku_code')->unique();
            $table->string('product_name');
            $table->string('category');
            $table->string('brand');
            $table->string('type');
            $table->string('seller_name')->nullable();
            $table->integer('price');
            $table->boolean('buyer_product_status')->default(true);
            $table->boolean('seller_product_status')->default(true);
            $table->boolean('unlimited_stock')->default(false);
            $table->integer('stock')->default(0);
            $table->boolean('multi')->default(true);
            $table->string('start_cut_off')->nullable();
            $table->string('end_cut_off')->nullable();
            $table->text('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
