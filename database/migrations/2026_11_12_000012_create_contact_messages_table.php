<?php

/**
 * Create Contact Messages Table Migration
 *
 * Stores general contact messages, project inquiries, job offers, and consultations.
 */

declare(strict_types=1);

use App\Enums\ContactMessageStatusEnum;
use App\Enums\ContactMessageTypeEnum;
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
        Schema::create('contact_messages', static function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->index();
            $table->string('phone', 30)->nullable();
            $table->string('subject')->nullable();
            $table->string('service')->nullable();
            $table->string('budget_range', 100)->nullable();
            $table->string('timeline', 100)->nullable();
            $table->text('message')->nullable();
            $table->string('type', 50)->default(ContactMessageTypeEnum::GeneralContact->value)->index();
            $table->string('status', 30)->default(ContactMessageStatusEnum::New->value)->index();
            $table->text('admin_notes')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->integer('sort_order')->default(0)->index();
            $table->integer('lft')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
