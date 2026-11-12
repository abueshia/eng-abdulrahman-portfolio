<?php

/**
 * SettingService
 *
 * Manages the Dynamic Settings Engine including forever-caching (`portfolio.settings`),
 * locale-aware resolution, fallback defaults via SettingKeyEnum, batch updates,
 * and Spatie MediaLibrary file uploads.
 */

declare(strict_types=1);

namespace App\Services;

use App\DTOs\SettingUpdateData;
use App\Enums\SettingGroupEnum;
use App\Enums\SettingKeyEnum;
use App\Enums\SettingTypeEnum;
use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Throwable;

class SettingService
{
    /**
     * Forever cache key for the portfolio settings collection.
     */
    public const CACHE_KEY = 'portfolio.settings';

    public function __construct(
        private readonly SettingRepositoryInterface $settingRepository
    ) {}

    /**
     * Retrieve a setting value by SettingKeyEnum or string key, resolved for the given locale.
     * Falls back to SettingKeyEnum::defaultForLocale() or $default if not persisted in DB.
     */
    public function get(SettingKeyEnum|string $key, ?string $locale = null, mixed $default = null): mixed
    {
        $keyString = $key instanceof SettingKeyEnum ? $key->value : $key;
        $enumCase = $key instanceof SettingKeyEnum ? $key : SettingKeyEnum::tryFrom($keyString);

        $cachedMap = $this->getCachedSettingsMap();

        if (isset($cachedMap[$keyString])) {
            $entry = $cachedMap[$keyString];

            if (! empty($entry['media_url'])) {
                return $entry['media_url'];
            }

            $rawValue = $entry['value'] ?? null;
            $isTranslatable = (bool) ($entry['is_translatable'] ?? false);

            if (is_array($rawValue)) {
                if (! $isTranslatable) {
                    $scalar = $rawValue['value'] ?? ($rawValue['en'] ?? null);
                    if ($scalar !== null && $scalar !== '') {
                        return $scalar;
                    }
                    if (! array_key_exists('value', $rawValue)) {
                        return $rawValue;
                    }
                } else {
                    $targetLocale = $locale ?? app()->getLocale();
                    $localized = $rawValue[$targetLocale]
                        ?? $rawValue['en']
                        ?? $rawValue['ar']
                        ?? null;

                    if ($localized !== null && $localized !== '') {
                        return $localized;
                    }
                }
            } elseif ($rawValue !== null && $rawValue !== '') {
                return $rawValue;
            }
        }

        if ($default !== null) {
            return $default;
        }

        return $enumCase?->defaultForLocale($locale);
    }

    /**
     * Retrieve the raw stored array value (e.g., ['ar' => '...', 'en' => '...']) for form editing.
     */
    public function getRaw(SettingKeyEnum|string $key): mixed
    {
        $keyString = $key instanceof SettingKeyEnum ? $key->value : $key;
        $enumCase = $key instanceof SettingKeyEnum ? $key : SettingKeyEnum::tryFrom($keyString);

        $cachedMap = $this->getCachedSettingsMap();
        if (isset($cachedMap[$keyString])) {
            return $cachedMap[$keyString]['value'];
        }

        return $enumCase?->default();
    }

    /**
     * Retrieve all settings for a specific SettingGroupEnum resolved for the given locale.
     *
     * @return array<string, mixed>
     */
    public function getGroupValues(SettingGroupEnum $group, ?string $locale = null): array
    {
        $result = [];
        foreach (SettingKeyEnum::forGroup($group) as $settingKey) {
            $result[$settingKey->value] = $this->get($settingKey, $locale);
        }

        return $result;
    }

    /**
     * Build a structured map of all dashboard tabs and their setting metadata/values for the Admin UI.
     *
     * @return array<string, array{
     *     group: SettingGroupEnum,
     *     items: array<string, array{
     *         enum: SettingKeyEnum,
     *         value: mixed,
     *         media_url: string|null
     *     }>
     * }>
     */
    public function getDashboardTabsData(): array
    {
        $cachedMap = $this->getCachedSettingsMap();
        $tabs = [];

        foreach (SettingGroupEnum::dashboardTabs() as $group) {
            $items = [];
            foreach (SettingKeyEnum::forGroup($group) as $settingKey) {
                $cachedEntry = $cachedMap[$settingKey->value] ?? null;
                $items[$settingKey->value] = [
                    'enum' => $settingKey,
                    'value' => $cachedEntry['value'] ?? $settingKey->default(),
                    'media_url' => $cachedEntry['media_url'] ?? null,
                ];
            }

            $tabs[$group->value] = [
                'group' => $group,
                'items' => $items,
            ];
        }

        return $tabs;
    }

    /**
     * Batch-update dynamic settings and handle MediaLibrary uploads within a transaction.
     */
    public function updateSettings(SettingUpdateData $dto): void
    {
        DB::transaction(function () use ($dto): void {
            // 1. Process standard key-value settings
            foreach ($dto->settings as $keyString => $submittedValue) {
                $enumCase = SettingKeyEnum::tryFrom((string) $keyString);
                if ($enumCase === null || $enumCase->isFileOrImage()) {
                    continue;
                }

                $normalizedValue = $this->normalizeSubmittedValue($enumCase, $submittedValue);

                $this->settingRepository->upsertByKey($enumCase->value, [
                    'group' => $enumCase->group(),
                    'value' => $normalizedValue,
                    'type' => $enumCase->type(),
                    'is_translatable' => $enumCase->isTranslatable(),
                ]);
            }

            // 2. Process uploaded files/images via Spatie MediaLibrary
            foreach ($dto->files as $keyString => $uploadedFile) {
                if (! $uploadedFile instanceof UploadedFile) {
                    continue;
                }

                $enumCase = SettingKeyEnum::tryFrom((string) $keyString);
                if ($enumCase === null || ! $enumCase->isFileOrImage()) {
                    continue;
                }

                $setting = $this->settingRepository->upsertByKey($enumCase->value, [
                    'group' => $enumCase->group(),
                    'type' => $enumCase->type(),
                    'is_translatable' => false,
                ]);

                $setting->clearMediaCollection('settings');
                $media = $setting->addMedia($uploadedFile)->toMediaCollection('settings');

                $setting->update([
                    'value' => ['value' => $media->getUrl()],
                ]);
            }
        });

        $this->clearCache();
    }

    /**
     * Clear the forever-cached settings map.
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
        Cache::forget('settings');
    }

    /**
     * Retrieve the cached map of all persisted settings keyed by setting `key`.
     *
     * @return array<string, array{
     *     group: string,
     *     key: string,
     *     value: mixed,
     *     type: string,
     *     is_translatable: bool,
     *     media_url: string|null
     * }>
     */
    public function getCachedSettingsMap(): array
    {
        try {
            /** @var array<string, array<string, mixed>> $cached */
            $cached = Cache::rememberForever(self::CACHE_KEY, function (): array {
                /** @var Collection<int, Setting> $records */
                $records = $this->settingRepository->allOrderedWithMedia();
                $map = [];

                foreach ($records as $setting) {
                    $settingKey = (string) ($setting->key ?: $setting->option);
                    if ($settingKey === '') {
                        continue;
                    }

                    $mediaUrl = $setting->getFirstMediaUrl('settings') ?: null;

                    $map[$settingKey] = [
                        'group' => $setting->group instanceof SettingGroupEnum
                            ? $setting->group->value
                            : (string) $setting->group,
                        'key' => $settingKey,
                        'value' => $setting->value,
                        'type' => $setting->type instanceof SettingTypeEnum
                            ? $setting->type->value
                            : (string) $setting->type,
                        'is_translatable' => (bool) $setting->is_translatable,
                        'media_url' => $mediaUrl,
                    ];
                }

                return $map;
            });

            return $cached;
        } catch (Throwable) {
            return [];
        }
    }

    /**
     * Normalize a submitted form value into its canonical JSON array structure.
     *
     * @return array<string, mixed>
     */
    private function normalizeSubmittedValue(SettingKeyEnum $enumCase, mixed $submittedValue): array
    {
        if ($enumCase->isTranslatable()) {
            if (is_array($submittedValue)) {
                return [
                    'ar' => (string) ($submittedValue['ar'] ?? ''),
                    'en' => (string) ($submittedValue['en'] ?? ''),
                ];
            }

            return [
                'ar' => (string) $submittedValue,
                'en' => (string) $submittedValue,
            ];
        }

        if ($enumCase->type() === SettingTypeEnum::Boolean) {
            $boolVal = filter_var(
                is_array($submittedValue) ? ($submittedValue['value'] ?? false) : $submittedValue,
                FILTER_VALIDATE_BOOLEAN
            );

            return ['value' => $boolVal];
        }

        if ($enumCase->type() === SettingTypeEnum::Json) {
            if (is_string($submittedValue)) {
                $decoded = json_decode($submittedValue, true);

                return is_array($decoded) ? $decoded : (array) $enumCase->default();
            }

            return is_array($submittedValue) ? $submittedValue : (array) $enumCase->default();
        }

        if (is_array($submittedValue)) {
            return ['value' => $submittedValue['value'] ?? reset($submittedValue) ?? ''];
        }

        return ['value' => (string) $submittedValue];
    }
}

