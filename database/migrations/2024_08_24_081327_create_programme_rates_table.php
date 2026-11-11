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
        Schema::create('programme_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('programme_booking_id');
            $table->unsignedBigInteger('programme_id');
            $table->integer('rate');
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->foreign('programme_booking_id')->references('id')->on('programme_bookings')->onDelete('CASCADE');
            $table->foreign('programme_id')->references('id')->on('programmes')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_rates');
    }
};
