<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('favorite_products', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('favorite_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); 
            $table->unsignedBigInteger('client_id');  
            $table->timestamps();

            // العلاقات
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->unique(['product_id', 'client_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_products');
    }
};
