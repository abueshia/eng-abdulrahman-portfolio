<?php

/**
 * Create Credentials Table Migration
 *
 * Stores academic degrees, professional certifications, specialized courses, and awards.
 */

declare(strict_types=1);

use App\Enums\CredentialTypeEnum;
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
        Schema::create('credentials', static function (Blueprint $table): void {
            $table->id();
            $table->json('title');
            $table->json('organization');
            $table->string('type', 50)->default(CredentialTypeEnum::ProfessionalCertificate->value)->index();
            $table->date('issued_at')->nullable()->index();
            $table->date('expires_at')->nullable();
            $table->string('credential_id', 100)->nullable();
            $table->string('credential_url')->nullable();
            $table->json('description')->nullable();
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
        Schema::dropIfExists('credentials');
    }
};
