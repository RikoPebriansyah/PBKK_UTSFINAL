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
        $table->string('product_id')->primary();
        $table->string('name')->notNullable();
        $table->string('description')->notNullable();
        $table->integer('price')->notNullable();
        $table->integer('stock')->notNullable();
        $table->string('category_id');
        $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
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
