<?php

/**
 * Create Project Technology Pivot Table Migration
 *
 * Links portfolio projects to the technologies used in their architecture.
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
        Schema::create('project_technology', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();
            $table->foreignId('technology_id')
                ->constrained('technologies')
                ->cascadeOnDelete();
            $table->string('role_in_project', 100)->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['project_id', 'technology_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
