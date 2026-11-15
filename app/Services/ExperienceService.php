<?php

/**
 * ExperienceService
 *
 * Manages professional career timeline entries, technology pivot synchronization,
 * company logo uploads, reordering, and cache invalidation.
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Experience;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use App\Services\Support\PortfolioCache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ExperienceService
{
    public const CACHE_MODULE = 'experiences';

    public function __construct(
        private readonly ExperienceRepositoryInterface $experienceRepository,
        private readonly PortfolioCache $cache,
    ) {}

    /**
     * Get all active experiences ordered chronologically with technologies and media (cached).
     *
     * @return Collection<int, Experience>
     */
    public function getActiveTimeline(): Collection
    {
        /** @var Collection<int, Experience> $experiences */
        $experiences = $this->cache->remember(
            self::CACHE_MODULE,
            'timeline',
            fn (): Collection => $this->experienceRepository->getActive(),
        );

        return $experiences;
    }

    /**
     * Paginate experiences for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->experienceRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Create a new experience entry from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated, ?UploadedFile $image = null): Experience
    {
        $experience = DB::transaction(function () use ($validated, $image): Experience {
            $technologyIds = is_array($validated['technologies'] ?? null)
                ? array_map('intval', $validated['technologies'])
                : [];

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['technologies'], $validated['image']);

            if (! empty($validated['is_current'])) {
                $validated['end_date'] = null;
            }

            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->experienceRepository->nextSortOrder();

            /** @var Experience $created */
            $created = $this->experienceRepository->create($validated);

            $this->experienceRepository->syncTechnologies($created, $technologyIds);

            if ($uploadedImage !== null) {
                $created->storeFile($uploadedImage);
            }

            return $created->load(['technologies', 'media']);
        });

        $this->flushCache();

        return $experience;
    }

    /**
     * Update an existing experience entry from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Experience $experience, array $validated, ?UploadedFile $image = null): Experience
    {
        $updated = DB::transaction(function () use ($experience, $validated, $image): Experience {
            $hasTechKey = array_key_exists('technologies', $validated);
            $technologyIds = is_array($validated['technologies'] ?? null)
                ? array_map('intval', $validated['technologies'])
                : [];

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['technologies'], $validated['image']);

            if (! empty($validated['is_current'])) {
                $validated['end_date'] = null;
            }

            /** @var Experience $saved */
            $saved = $this->experienceRepository->update($experience, $validated);

            if ($hasTechKey) {
                $this->experienceRepository->syncTechnologies($saved, $technologyIds);
            }

            if ($uploadedImage !== null) {
                $saved->updateFile($uploadedImage);
            }

            return $saved->load(['technologies', 'media']);
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete an experience entry and detach its technologies/media.
     */
    public function delete(Experience $experience): bool
    {
        $deleted = DB::transaction(function () use ($experience): bool {
            $experience->technologies()->detach();
            $experience->deleteFiles();

            return $this->experienceRepository->delete($experience);
        });

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder experience timeline items.
     *
     * @param  array<int, int|array{id: int, sort_order?: int}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->experienceRepository->reorder($items);
        });

        $this->flushCache();
    }

    /**
     * Flush cached experience query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([self::CACHE_MODULE]);
    }
}
