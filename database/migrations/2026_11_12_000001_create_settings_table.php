<?php

/**
 * Create Settings Table Migration
 *
 * Stores grouped, typed, and translatable dynamic portfolio configuration
 * including General Identity, Hero, About, Contact, Social Links, and SEO.
 */

declare(strict_types=1);

use App\Enums\SettingGroupEnum;
use App\Enums\SettingTypeEnum;
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
        Schema::create('settings', static function (Blueprint $table): void {
            $table->id();
            $table->string('group', 50)->default(SettingGroupEnum::General->value)->index();
            $table->string('key', 100)->unique();
            $table->string('option', 100)->nullable()->index();
            $table->json('value')->nullable();
            $table->string('type', 30)->default(SettingTypeEnum::Text->value);
            $table->boolean('is_translatable')->default(true);
            $table->integer('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
