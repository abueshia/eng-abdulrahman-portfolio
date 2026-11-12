<?php

/**
 * Create Services Table Migration
 *
 * Stores software engineering services offered by Eng. Abdelrahman Abu Aishah.
 */

declare(strict_types=1);

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
        Schema::create('services', static function (Blueprint $table): void {
            $table->id();
            $table->json('title');
            $table->string('slug')->unique()->index();
            $table->json('subtitle')->nullable();
            $table->json('short_description');
            $table->json('description')->nullable();
            $table->json('features')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
