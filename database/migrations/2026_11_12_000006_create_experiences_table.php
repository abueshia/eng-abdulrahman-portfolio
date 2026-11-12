<?php

/**
 * Create Experiences Table Migration
 *
 * Stores professional work history and career timeline entries.
 */

declare(strict_types=1);

use App\Enums\EmploymentTypeEnum;
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
        Schema::create('experiences', static function (Blueprint $table): void {
            $table->id();
            $table->json('company_name');
            $table->json('role_title');
            $table->string('employment_type', 50)->default(EmploymentTypeEnum::FullTime->value)->index();
            $table->json('location')->nullable();
            $table->string('company_url')->nullable();
            $table->date('start_date')->index();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false)->index();
            $table->json('summary');
            $table->json('achievements')->nullable();
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
        Schema::dropIfExists('experiences');
    }
};
