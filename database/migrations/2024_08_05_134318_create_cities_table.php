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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
            $table->timestamps();
            
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
