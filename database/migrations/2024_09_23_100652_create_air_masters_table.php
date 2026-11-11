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
        Schema::create('air_masters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('country_code')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('city_code')->nullable();
            $table->string('airport_name')->nullable();
            $table->string('airport_iata_code')->nullable();
            $table->string('is_active')->nullable();
            $table->string('en')->nullable();
            $table->string('ar')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('timezone_off_set')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_masters');
    }
};
