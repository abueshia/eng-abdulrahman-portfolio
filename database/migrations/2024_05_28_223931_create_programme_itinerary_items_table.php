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
        Schema::create('programme_itinerary_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_itinerary_id')->constrained('programme_itineraries', 'id')->onDelete('CASCADE');
            $table->json('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_itinerary_items');
    }
};
