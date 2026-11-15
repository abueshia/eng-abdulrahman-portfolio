<?php

/**
 * ProjectService
 *
 * Orchestrates business logic for portfolio projects and case studies,
 * including unique slug generation, technology pivot synchronization,
 * cover/gallery MediaLibrary uploads, reordering, and cache invalidation.
 */

declare(strict_types=1);

namespace App\Services;

use App\DTOs\ProjectData;
use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Services\Support\PortfolioCache;
use App\Services\Support\SlugGenerator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    public const CACHE_MODULE = 'projects';

    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly SlugGenerator $slugGenerator,
        private readonly PortfolioCache $cache,
    ) {}

    /**
     * Get published and active projects with eager-loaded relations (cached).
     *
     * @return Collection<int, Project>
     */
    public function getPublished(?int $limit = null): Collection
    {
        $variant = 'published:'.($limit ?? 'all');

        /** @var Collection<int, Project> $projects */
        $projects = $this->cache->remember(
            self::CACHE_MODULE,
            $variant,
            fn (): Collection => $this->projectRepository->getPublished($limit),
        );

        return $projects;
    }

    /**
     * Get featured and published projects with eager-loaded relations (cached).
     *
     * @return Collection<int, Project>
     */
    public function getFeatured(int $limit = 6): Collection
    {
        /** @var Collection<int, Project> $projects */
        $projects = $this->cache->remember(
            self::CACHE_MODULE,
            "featured:{$limit}",
            fn (): Collection => $this->projectRepository->getFeatured($limit),
        );

        return $projects;
    }

    /**
     * Paginate published projects with optional filters for public website or REST API.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginatePublished(int $perPage = 9, array $filters = []): LengthAwarePaginator
    {
        return $this->projectRepository->paginatePublished($perPage, $filters);
    }

    /**
     * Paginate projects for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->projectRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Find a published project by its slug with full case-study relations.
     */
    public function findBySlug(string $slug, bool $publishedOnly = true): ?Project
    {
        return $this->projectRepository->findBySlugWithRelations($slug, $publishedOnly);
    }

    /**
     * Find a project by ID with relations for Admin editing.
     */
    public function findById(int $id): ?Project
    {
        return $this->projectRepository->findById(
            $id,
            ['*'],
            ['category', 'technologies', 'testimonials', 'media']
        );
    }

    /**
     * Get related published projects for a given project.
     *
     * @return Collection<int, Project>
     */
    public function getRelated(Project $project, int $limit = 3): Collection
    {
        return $this->projectRepository->getRelated($project, $limit);
    }

    /**
     * Create a new portfolio project from a validated ProjectData DTO.
     */
    public function create(ProjectData $dto): Project
    {
        $project = DB::transaction(function () use ($dto): Project {
            $slug = $this->slugGenerator->generate(
                $this->projectRepository,
                $dto->preferredSlugSource()
            );

            $sortOrder = $dto->sortOrder ?? $this->projectRepository->nextSortOrder();
            $attributes = $dto->toAttributes($slug, $sortOrder);

            /** @var Project $created */
            $created = $this->projectRepository->create($attributes);

            $this->projectRepository->syncTechnologies($created, $dto->technologies);

            if ($dto->coverImage !== null) {
                $created->storeFile($dto->coverImage);
            }

            if (! empty($dto->galleryImages)) {
                $created->storeFiles($dto->galleryImages, '_gallery');
            }

            return $created->load(['category', 'technologies', 'media']);
        });

        $this->flushCache();

        return $project;
    }

    /**
     * Update an existing portfolio project from a validated ProjectData DTO.
     */
    public function update(Project $project, ProjectData $dto): Project
    {
        $updated = DB::transaction(function () use ($project, $dto): Project {
            $slugSource = $dto->slug ?? $project->slug ?: $dto->preferredSlugSource();
            $slug = $this->slugGenerator->generate(
                $this->projectRepository,
                $slugSource,
                $project->id
            );

            $attributes = $dto->toAttributes($slug, $project->sort_order);

            /** @var Project $saved */
            $saved = $this->projectRepository->update($project, $attributes);

            $this->projectRepository->syncTechnologies($saved, $dto->technologies);

            if ($dto->coverImage !== null) {
                $saved->updateFile($dto->coverImage);
            }

            if (! empty($dto->galleryImages)) {
                if ($dto->replaceGallery) {
                    $saved->updateFiles($dto->galleryImages, '_gallery');
                } else {
                    $saved->storeFiles($dto->galleryImages, '_gallery');
                }
            }

            return $saved->load(['category', 'technologies', 'media']);
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete a project and clear its media collections.
     */
    public function delete(Project $project): bool
    {
        $deleted = DB::transaction(function () use ($project): bool {
            $project->technologies()->detach();
            $project->deleteFiles();
            $project->deleteFiles('_gallery');

            return $this->projectRepository->delete($project);
        });

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder projects by an array of IDs or structured sort items.
     *
     * @param  array<int, int|array{id: int, sort_order?: int, lft?: int, rgt?: int, depth?: int, parent_id?: int|null}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->projectRepository->reorder($items);
        });

        $this->flushCache();
    }

    /**
     * Flush cached project and related module query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([
            self::CACHE_MODULE,
            CategoryService::CACHE_MODULE,
            TechnologyService::CACHE_MODULE,
            TestimonialService::CACHE_MODULE,
        ]);
    }
}

