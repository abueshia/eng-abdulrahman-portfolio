<?php

/**
 * EloquentSettingRepository
 *
 * Eloquent implementation of SettingRepositoryInterface for managing dynamic settings.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\SettingGroupEnum;
use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentSettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    /**
     * Initialize the repository with the Setting model.
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function allOrderedWithMedia(): Collection
    {
        /** @var Collection<int, Setting> $settings */
        $settings = $this->query()
            ->with('media')
            ->ordered()
            ->get();

        return $settings;
    }

    /**
     * {@inheritDoc}
     */
    public function findByKey(string $key): ?Setting
    {
        /** @var Setting|null $setting */
        $setting = $this->query()
            ->with('media')
            ->where('key', $key)
            ->orWhere('option', $key)
            ->first();

        return $setting;
    }

    /**
     * {@inheritDoc}
     */
    public function getByGroup(SettingGroupEnum|string $group): Collection
    {
        /** @var Collection<int, Setting> $settings */
        $settings = $this->query()
            ->with('media')
            ->byGroup($group)
            ->ordered()
            ->get();

        return $settings;
    }

    /**
     * {@inheritDoc}
     */
    public function upsertByKey(string $key, array $attributes): Setting
    {
        /** @var Setting $setting */
        $setting = $this->query()->updateOrCreate(
            ['key' => $key],
            array_merge($attributes, ['option' => $key])
        );

        return $setting;
    }
}

