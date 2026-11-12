<?php

/**
 * Create Technologies Table Migration
 *
 * Stores technical stack items (PHP, Laravel, React.js, MySQL, Redis, Docker, etc.)
 * categorized by TechnologyCategoryEnum.
 */

declare(strict_types=1);

use App\Enums\TechnologyCategoryEnum;
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
        Schema::create('technologies', static function (Blueprint $table): void {
            $table->id();
            $table->json('name');
            $table->string('slug')->unique()->index();
            $table->string('category', 50)->default(TechnologyCategoryEnum::Backend->value)->index();
            $table->string('icon')->nullable();
            $table->string('badge_color', 30)->nullable();
            $table->unsignedTinyInteger('proficiency_percent')->default(90);
            $table->decimal('years_of_experience', 3, 1)->default(4.0);
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
        Schema::dropIfExists('technologies');
    }
};
