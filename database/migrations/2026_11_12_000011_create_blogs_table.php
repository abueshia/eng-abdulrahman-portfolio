<?php

/**
 * Create Blogs Table Migration
 *
 * Stores bilingual technical articles, tutorials, and architectural insights.
 */

declare(strict_types=1);

use App\Enums\BlogStatusEnum;
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
        Schema::create('blogs', static function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->json('name');
            $table->string('slug')->unique()->index();
            $table->json('short_description')->nullable();
            $table->json('description');
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->string('meta_tags')->nullable();
            $table->string('alt_text')->nullable();
            $table->unsignedSmallInteger('reading_time_minutes')->default(5);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->string('status', 30)->default(BlogStatusEnum::Published->value)->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->integer('sort_order')->default(0)->index();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
