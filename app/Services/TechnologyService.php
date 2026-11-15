<?php

/**
 * TechnologyService
 *
 * Manages CRUD operations, slug generation, icon/logo uploads, reordering,
 * and cache invalidation for technical skills and stack technologies.
 */

declare(strict_types=1);

namespace App\Services;

use App\Enums\TechnologyCategoryEnum;
use App\Models\Technology;
use App\Repositories\Contracts\TechnologyRepositoryInterface;
use App\Services\Support\PortfolioCache;
use App\Services\Support\SlugGenerator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class TechnologyService
{
    public const CACHE_MODULE = 'technologies';

    public function __construct(
        private readonly TechnologyRepositoryInterface $technologyRepository,
        private readonly SlugGenerator $slugGenerator,
        private readonly PortfolioCache $cache,
    ) {}

    /**
     * Get all active technologies ordered for public display (cached).
     *
     * @return Collection<int, Technology>
     */
    public function getActive(?TechnologyCategoryEnum $category = null): Collection
    {
        $variant = 'active:'.($category?->value ?? 'all');

        /** @var Collection<int, Technology> $technologies */
        $technologies = $this->cache->remember(
            self::CACHE_MODULE,
            $variant,
            fn (): Collection => $category !== null
                ? $this->technologyRepository->getByCategory($category)
                : $this->technologyRepository->getActive(),
        );

        return $technologies;
    }

    /**
     * Get featured active technologies (cached).
     *
     * @return Collection<int, Technology>
     */
    public function getFeatured(int $limit = 12): Collection
    {
        $variant = "featured:{$limit}";

        /** @var Collection<int, Technology> $technologies */
        $technologies = $this->cache->remember(
            self::CACHE_MODULE,
            $variant,
            fn (): Collection => $this->technologyRepository->getFeatured($limit),
        );

        return $technologies;
    }

    /**
     * Get active technologies grouped by category key (cached).
     *
     * @return \Illuminate\Support\Collection<string, Collection<int, Technology>>
     */
    public function getGroupedByCategory(): \Illuminate\Support\Collection
    {
        /** @var \Illuminate\Support\Collection<string, Collection<int, Technology>> $grouped */
        $grouped = $this->cache->remember(
            self::CACHE_MODULE,
            'grouped',
            fn (): \Illuminate\Support\Collection => $this->technologyRepository->getGroupedByCategory(),
        );

        return $grouped;
    }

    /**
     * Paginate technologies for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->technologyRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Build an ordered Eloquent query with eager-loaded relations for Admin Yajra DataTables.
     *
     * @return Builder<Technology>
     */
    public function getAdminDataTableQuery(): Builder
    {
        /** @var Builder<Technology> $query */
        $query = $this->technologyRepository->adminQuery(['media']);

        return $query;
    }

    /**
     * Get all technologies ordered by sort_order for the Admin drag-and-drop reorder screen.
     *
     * @return Collection<int, Technology>
     */
    public function getAllForReorder(): Collection
    {
        /** @var Collection<int, Technology> $technologies */
        $technologies = $this->technologyRepository->all(['*'], ['media']);

        return $technologies;
    }

    /**
     * Create a new technology entry from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated, ?UploadedFile $image = null): Technology
    {
        $technology = DB::transaction(function () use ($validated, $image): Technology {
            $nameArray = is_array($validated['name'] ?? null) ? $validated['name'] : [];
            $slugSource = isset($validated['slug']) && trim((string) $validated['slug']) !== ''
                ? trim((string) $validated['slug'])
                : (string) ($nameArray['en'] ?? $nameArray['ar'] ?? 'technology');

            $validated['slug'] = $this->slugGenerator->generate($this->technologyRepository, $slugSource);
            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->technologyRepository->nextSortOrder();

            $uploadedImage = $image ?? (($validated['image'] ?? null) instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Technology $created */
            $created = $this->technologyRepository->create($validated);

            if ($uploadedImage !== null) {
                $created->storeFile($uploadedImage);
            }

            return $created->load('media');
        });

        $this->flushCache();

        return $technology;
    }

    /**
     * Update an existing technology entry from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Technology $technology, array $validated, ?UploadedFile $image = null): Technology
    {
        $updated = DB::transaction(function () use ($technology, $validated, $image): Technology {
            $nameArray = is_array($validated['name'] ?? null)
                ? $validated['name']
                : $technology->getTranslations('name');

            $slugSource = isset($validated['slug']) && trim((string) $validated['slug']) !== ''
                ? trim((string) $validated['slug'])
                : ($technology->slug ?: (string) ($nameArray['en'] ?? $nameArray['ar'] ?? 'technology'));

            $validated['slug'] = $this->slugGenerator->generate(
                $this->technologyRepository,
                $slugSource,
                $technology->id
            );

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Technology $saved */
            $saved = $this->technologyRepository->update($technology, $validated);

            if ($uploadedImage !== null) {
                $saved->updateFile($uploadedImage);
            }

            return $saved->load('media');
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete a technology and clear its media collection.
     */
    public function delete(Technology $technology): bool
    {
        $deleted = DB::transaction(function () use ($technology): bool {
            $technology->projects()->detach();
            $technology->experiences()->detach();
            $technology->deleteFiles();

            return $this->technologyRepository->delete($technology);
        });

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder technologies.
     *
     * @param  array<int, int|array{id: int, sort_order?: int}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->technologyRepository->reorder($items);
        });

        $this->flushCache();
    }

    /**
     * Flush cached technology and related module query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([
            self::CACHE_MODULE,
            ProjectService::CACHE_MODULE,
            ExperienceService::CACHE_MODULE,
        ]);
    }
}
