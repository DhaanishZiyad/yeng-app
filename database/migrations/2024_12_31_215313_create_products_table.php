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
            $table->id(); // Primary key (id)
            $table->string('name'); // Name of the product
            $table->decimal('price', 10, 2); // Price of the product
            $table->integer('quantity'); // Quantity in stock
            $table->text('description')->nullable(); // Product description
            $table->string('image_path')->nullable(); // Path to the product image
            $table->timestamps(); // created_at and updated_at timestamps
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
