<?php

/**
 * CategoryService
 *
 * Manages bilingual project and article categories, unique slug generation,
 * cover image uploads, reordering, and cache invalidation.
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Services\Support\PortfolioCache;
use App\Services\Support\SlugGenerator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public const CACHE_MODULE = 'categories';

    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly SlugGenerator $slugGenerator,
        private readonly PortfolioCache $cache,
    ) {}

    /**
     * Get all active categories ordered by sort_order with published counts (cached).
     *
     * @return Collection<int, Category>
     */
    public function getActiveWithCounts(): Collection
    {
        /** @var Collection<int, Category> $categories */
        $categories = $this->cache->remember(
            self::CACHE_MODULE,
            'active_with_counts',
            fn (): Collection => $this->categoryRepository->getActiveWithPublishedCounts(),
        );

        return $categories;
    }

    /**
     * Find a category by its slug.
     */
    public function findBySlug(string $slug, bool $activeOnly = true): Category
    {
        return $this->categoryRepository->findBySlugWithRelations($slug, $activeOnly);
    }

    /**
     * Paginate categories for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->categoryRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Create a new category from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated, ?UploadedFile $image = null): Category
    {
        $category = DB::transaction(function () use ($validated, $image): Category {
            $nameArray = is_array($validated['name'] ?? null) ? $validated['name'] : [];
            $slugSource = isset($validated['slug']) && trim((string) $validated['slug']) !== ''
                ? trim((string) $validated['slug'])
                : (string) ($nameArray['en'] ?? $nameArray['ar'] ?? 'category');

            $validated['slug'] = $this->slugGenerator->generate($this->categoryRepository, $slugSource);
            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->categoryRepository->nextSortOrder();

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Category $created */
            $created = $this->categoryRepository->create($validated);

            if ($uploadedImage !== null) {
                $created->storeFile($uploadedImage);
            }

            return $created->load('media');
        });

        $this->flushCache();

        return $category;
    }

    /**
     * Update an existing category from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Category $category, array $validated, ?UploadedFile $image = null): Category
    {
        $updated = DB::transaction(function () use ($category, $validated, $image): Category {
            $nameArray = is_array($validated['name'] ?? null)
                ? $validated['name']
                : $category->getTranslations('name');

            $slugSource = isset($validated['slug']) && trim((string) $validated['slug']) !== ''
                ? trim((string) $validated['slug'])
                : ($category->slug ?: (string) ($nameArray['en'] ?? $nameArray['ar'] ?? 'category'));

            $validated['slug'] = $this->slugGenerator->generate(
                $this->categoryRepository,
                $slugSource,
                $category->id
            );

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Category $saved */
            $saved = $this->categoryRepository->update($category, $validated);

            if ($uploadedImage !== null) {
                $saved->updateFile($uploadedImage);
            }

            return $saved->load('media');
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete a category and clear its media collection.
     */
    public function delete(Category $category): bool
    {
        $deleted = DB::transaction(function () use ($category): bool {
            $category->deleteFiles();

            return $this->categoryRepository->delete($category);
        });

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder categories.
     *
     * @param  array<int, int|array{id: int, sort_order?: int, lft?: int, rgt?: int, depth?: int, parent_id?: int|null}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->categoryRepository->reorder($items);
        });

        $this->flushCache();
    }

    /**
     * Flush cached category, project, and blog query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([
            self::CACHE_MODULE,
            ProjectService::CACHE_MODULE,
            BlogService::CACHE_MODULE,
        ]);
    }
}
