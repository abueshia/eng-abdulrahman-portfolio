<?php

/**
 * ServiceCatalogService
 *
 * Manages software engineering service offerings, unique slug generation,
 * cover/icon media uploads, reordering, and cache invalidation.
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Services\Support\PortfolioCache;
use App\Services\Support\SlugGenerator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ServiceCatalogService
{
    public const CACHE_MODULE = 'services';

    public function __construct(
        private readonly ServiceRepositoryInterface $serviceRepository,
        private readonly SlugGenerator $slugGenerator,
        private readonly PortfolioCache $cache,
    ) {}

    /**
     * Get active services ordered by sort_order (cached).
     *
     * @return Collection<int, Service>
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Service> $services */
        $services = $this->cache->remember(
            self::CACHE_MODULE,
            'active:all',
            fn (): Collection => $this->serviceRepository->getActive(),
        );

        return $services;
    }

    /**
     * Get featured active services (cached).
     *
     * @return Collection<int, Service>
     */
    public function getFeatured(int $limit = 6): Collection
    {
        $variant = "featured:{$limit}";

        /** @var Collection<int, Service> $services */
        $services = $this->cache->remember(
            self::CACHE_MODULE,
            $variant,
            fn (): Collection => $this->serviceRepository->getFeatured($limit),
        );

        return $services;
    }

    /**
     * Find a service by slug.
     */
    public function findBySlug(string $slug, bool $activeOnly = true): Service
    {
        return $this->serviceRepository->findBySlugWithRelations($slug, $activeOnly);
    }

    /**
     * Paginate services for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->serviceRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Create a new service offering from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated, ?UploadedFile $image = null): Service
    {
        $service = DB::transaction(function () use ($validated, $image): Service {
            $titleArray = is_array($validated['title'] ?? null) ? $validated['title'] : [];
            $slugSource = isset($validated['slug']) && trim((string) $validated['slug']) !== ''
                ? trim((string) $validated['slug'])
                : (string) ($titleArray['en'] ?? $titleArray['ar'] ?? 'service');

            $validated['slug'] = $this->slugGenerator->generate($this->serviceRepository, $slugSource);
            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->serviceRepository->nextSortOrder();

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Service $created */
            $created = $this->serviceRepository->create($validated);

            if ($uploadedImage !== null) {
                $created->storeFile($uploadedImage);
            }

            return $created->load('media');
        });

        $this->flushCache();

        return $service;
    }

    /**
     * Update an existing service offering from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Service $service, array $validated, ?UploadedFile $image = null): Service
    {
        $updated = DB::transaction(function () use ($service, $validated, $image): Service {
            $titleArray = is_array($validated['title'] ?? null)
                ? $validated['title']
                : $service->getTranslations('title');

            $slugSource = isset($validated['slug']) && trim((string) $validated['slug']) !== ''
                ? trim((string) $validated['slug'])
                : ($service->slug ?: (string) ($titleArray['en'] ?? $titleArray['ar'] ?? 'service'));

            $validated['slug'] = $this->slugGenerator->generate(
                $this->serviceRepository,
                $slugSource,
                $service->id
            );

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Service $saved */
            $saved = $this->serviceRepository->update($service, $validated);

            if ($uploadedImage !== null) {
                $saved->updateFile($uploadedImage);
            }

            return $saved->load('media');
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete a service offering and clear its media collection.
     */
    public function delete(Service $service): bool
    {
        $deleted = DB::transaction(function () use ($service): bool {
            $service->deleteFiles();

            return $this->serviceRepository->delete($service);
        });

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder services.
     *
     * @param  array<int, int|array{id: int, sort_order?: int}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->serviceRepository->reorder($items);
        });

        $this->flushCache();
    }

    /**
     * Flush cached service query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([self::CACHE_MODULE]);
    }
}

