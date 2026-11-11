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
        Schema::create('programmes', function (Blueprint $table) {
            // 1
            $table->id();
            $table->json('name');
            $table->foreignId('country_id')->constrained('countries', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('region_id')->nullable()->constrained('regions', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->json('location_name');
            $table->string('rate');
            $table->string('star');
            // 4
            $table->bigInteger('duration');
            $table->foreignId('tour_type_id')->constrained('tour_types', 'id')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('group_size');
            $table->json('description');
            // 7
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->string('map')->nullable();
            $table->time('check_in');
            $table->time('check_out');
            $table->tinyInteger('status')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->decimal('is_featured')->nullable();

            // 2
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('gmail')->nullable();

            // 3
            $table->double('price')->default(0);
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            // 5
            $table->bigInteger('discount')->default(0);
            $table->enum('discount_type', ['percent', 'fixed'])->default('percent');
            // 6
            $table->string('tax')->default(0);
            // 8
            $table->double('avg_rate')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
