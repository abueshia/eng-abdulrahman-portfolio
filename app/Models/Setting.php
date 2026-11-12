<?php

/**
 * Setting Model
 *
 * Represents a grouped, typed, and optionally translatable dynamic setting
 * (General, Hero, About, Contact, Social, SEO).
 */

declare(strict_types=1);

namespace App\Models;

use App\Enums\SettingGroupEnum;
use App\Enums\SettingTypeEnum;
use App\Traits\HandleUploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HandleUploadFile;
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group',
        'key',
        'option',
        'value',
        'type',
        'is_translatable',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'group' => SettingGroupEnum::class,
        'type' => SettingTypeEnum::class,
        'value' => 'array',
        'is_translatable' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Automatically synchronize the legacy `option` column with `key` on save.
     */
    protected static function booted(): void
    {
        static::saving(static function (self $setting): void {
            if (empty($setting->option) && ! empty($setting->key)) {
                $setting->option = $setting->key;
            } elseif (empty($setting->key) && ! empty($setting->option)) {
                $setting->key = $setting->option;
            }
        });
    }

    /**
     * Register media collections for image/file settings (e.g., profile photo, CV PDF).
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('settings')->singleFile();
    }

    /**
     * Resolve the setting value for the given locale (or current app locale).
     */
    public function localizedValue(?string $locale = null, mixed $default = null): mixed
    {
        $raw = $this->value;
        if (! is_array($raw)) {
            return $raw ?? $default;
        }

        if (! $this->is_translatable) {
            return $raw['value'] ?? $raw['en'] ?? $raw[0] ?? reset($raw) ?: $default;
        }

        $targetLocale = $locale ?? app()->getLocale();

        return $raw[$targetLocale]
            ?? $raw['en']
            ?? $raw['ar']
            ?? reset($raw)
            ?: $default;
    }

    /**
     * Scope a query to filter settings by SettingGroupEnum.
     *
     * @param  Builder<Setting>  $query
     * @return Builder<Setting>
     */
    public function scopeByGroup(Builder $query, SettingGroupEnum|string $group): Builder
    {
        $value = $group instanceof SettingGroupEnum ? $group->value : $group;

        return $query->where('group', $value);
    }

    /**
     * Scope a query to order settings by group and sort_order.
     *
     * @param  Builder<Setting>  $query
     * @return Builder<Setting>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('group', 'asc')->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }
}
