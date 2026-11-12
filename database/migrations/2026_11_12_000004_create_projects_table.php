<?php

/**
 * Create Projects Table Migration
 *
 * Stores software engineering projects and detailed architectural case studies
 * with Challenge, Solution, and Measurable Results.
 */

declare(strict_types=1);

use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
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
        Schema::create('projects', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->json('title');
            $table->string('slug')->unique()->index();
            $table->json('subtitle')->nullable();
            $table->json('short_description');
            $table->json('description')->nullable();
            $table->json('challenge')->nullable();
            $table->json('solution')->nullable();
            $table->json('results')->nullable();
            $table->json('client_name')->nullable();
            $table->json('role_title')->nullable();
            $table->string('project_type', 50)->default(ProjectTypeEnum::FullStack->value)->index();
            $table->string('status', 30)->default(ProjectStatusEnum::Published->value)->index();
            $table->string('live_url')->nullable();
            $table->string('repo_url')->nullable();
            $table->string('video_url')->nullable();
            $table->date('completed_at')->nullable()->index();
            $table->json('duration')->nullable();
            $table->json('metrics')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
