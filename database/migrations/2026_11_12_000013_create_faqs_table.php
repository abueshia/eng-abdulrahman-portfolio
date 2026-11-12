<?php

/**
 * Create FAQs Table Migration
 *
 * Stores frequently asked questions about development process, architecture, and hiring.
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
        Schema::create('faqs', static function (Blueprint $table): void {
            $table->id();
            $table->json('question');
            $table->json('answer');
            $table->string('category', 50)->default('general')->index();
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
        Schema::dropIfExists('faqs');
    }
};
