<?php

/**
 * Create Experience Technology Pivot Table Migration
 *
 * Links professional work experiences to the technologies utilized in each role.
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
        Schema::create('experience_technology', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('experience_id')
                ->constrained('experiences')
                ->cascadeOnDelete();
            $table->foreignId('technology_id')
                ->constrained('technologies')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['experience_id', 'technology_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_technology');
    }
};
