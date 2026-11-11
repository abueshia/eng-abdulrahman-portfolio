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
        Schema::table('cards', function (Blueprint $table) {
            $table->unsignedBigInteger('categorycolid_id')->nullable(); 

            $table->foreign('categorycolid_id')
            ->references('id')
            ->on('category_colid')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            //
        });
    }
};
