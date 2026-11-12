<?php

/**
 * SettingRepositoryInterface
 *
 * Contract for querying and persisting dynamic portfolio Setting records.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Enums\SettingGroupEnum;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Retrieve all settings ordered by group and sort_order with media relations.
     *
     * @return Collection<int, Setting>
     */
    public function allOrderedWithMedia(): Collection;

    /**
     * Find a setting record by its unique key, or return null if not found.
     */
    public function findByKey(string $key): ?Setting;

    /**
     * Retrieve all settings belonging to a specific SettingGroupEnum.
     *
     * @return Collection<int, Setting>
     */
    public function getByGroup(SettingGroupEnum|string $group): Collection;

    /**
     * Create or update a setting record by its unique key.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function upsertByKey(string $key, array $attributes): Setting;
}

