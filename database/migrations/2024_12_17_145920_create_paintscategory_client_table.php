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
        Schema::create('paintscategory_client', function (Blueprint $table) {
            $table->id();
          
            $table->unsignedBigInteger('paintscategory_id');
            $table->unsignedBigInteger('client_id');

            $table->foreign('paintscategory_id')->references('id')->on('paints_category')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paintscategory_client');
    }
};
