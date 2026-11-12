<?php

/**
 * SettingObserver
 *
 * Automatically invalidates the cached portfolio settings whenever a Setting
 * model is created, updated, saved, or deleted.
 */

declare(strict_types=1);

namespace App\Observers;

use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Support\Facades\Cache;

class SettingObserver
{
    /**
     * Handle the Setting "saved" event (covers both created and updated).
     */
    public function saved(Setting $setting): void
    {
        $this->flushCache();
    }

    /**
     * Handle the Setting "deleted" event.
     */
    public function deleted(Setting $setting): void
    {
        $this->flushCache();
    }

    /**
     * Clear all setting cache keys.
     */
    private function flushCache(): void
    {
        Cache::forget(SettingService::CACHE_KEY);
        Cache::forget('settings');
    }
}

