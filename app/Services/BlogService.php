<?php

/**
 * BlogService
 *
 * Manages bilingual technical articles and tutorials, unique slug generation,
 * cover media uploads, view counter increments, reordering, and cache invalidation.
 */

declare(strict_types=1);

namespace App\Services;

use App\Enums\BlogStatusEnum;
use App\Helpers\ReorderHelper;
use App\Models\Blog;
use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Services\Support\PortfolioCache;
use App\Services\Support\SlugGenerator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class BlogService
{
    public const CACHE_MODULE = 'blogs';

    private readonly BlogRepositoryInterface $blogRepository;

    private readonly SlugGenerator $slugGenerator;

    private readonly PortfolioCache $cache;

    public function __construct(
        ?BlogRepositoryInterface $blogRepository = null,
        ?SlugGenerator $slugGenerator = null,
        ?PortfolioCache $cache = null,
    ) {
        $this->blogRepository = $blogRepository ?? app(BlogRepositoryInterface::class);
        $this->slugGenerator = $slugGenerator ?? app(SlugGenerator::class);
        $this->cache = $cache ?? app(PortfolioCache::class);
    }

    /**
     * Get published and active technical articles (cached).
     *
     * @return Collection<int, Blog>
     */
    public function getPublished(?int $limit = null): Collection
    {
        $variant = 'published:'.($limit ?? 'all');

        /** @var Collection<int, Blog> $blogs */
        $blogs = $this->cache->remember(
            self::CACHE_MODULE,
            $variant,
            fn (): Collection => $this->blogRepository->getPublished($limit),
        );

        return $blogs;
    }

    /**
     * Get featured and published technical articles (cached).
     *
     * @return Collection<int, Blog>
     */
    public function getFeatured(int $limit = 3): Collection
    {
        /** @var Collection<int, Blog> $blogs */
        $blogs = $this->cache->remember(
            self::CACHE_MODULE,
            "featured:{$limit}",
            fn (): Collection => $this->blogRepository->getFeatured($limit),
        );

        return $blogs;
    }

    /**
     * Paginate published articles with optional filters.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginatePublished(int $perPage = 9, array $filters = []): LengthAwarePaginator
    {
        return $this->blogRepository->paginatePublished($perPage, $filters);
    }

    /**
     * Find a published article by slug with its category and media.
     */
    public function findBySlug(string $slug, bool $publishedOnly = true): ?Blog
    {
        try {
            if (! $publishedOnly) {
                return $this->blogRepository->findBySlugWithRelations($slug, false);
            }

            /** @var Blog $blog */
            $blog = $this->cache->remember(
                self::CACHE_MODULE,
                "slug:{$slug}",
                fn (): Blog => $this->blogRepository->findBySlugWithRelations($slug, true),
            );

            return $blog;
        } catch (ModelNotFoundException) {
            return null;
        }
    }

    /**
     * Get related published articles for a given article.
     *
     * @return Collection<int, Blog>
     */
    public function getRelated(Blog $blog, int $limit = 3): Collection
    {
        return $this->blogRepository->getRelated($blog, $limit);
    }

    /**
     * Increment the view count of a technical article.
     */
    public function incrementViews(Blog $blog): void
    {
        $this->blogRepository->incrementViews($blog);
    }

    /**
     * Paginate articles for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->blogRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Build an ordered Eloquent query with eager-loaded relations for Admin Yajra DataTables.
     *
     * @return Builder<Blog>
     */
    public function getAdminDataTableQuery(): Builder
    {
        /** @var Builder<Blog> $query */
        $query = $this->blogRepository->adminQuery(['category', 'media']);

        return $query;
    }

    /**
     * Get all blogs ordered by sort_order for the Admin drag-and-drop reorder screen.
     *
     * @return Collection<int, Blog>
     */
    public function getAllForReorder(): Collection
    {
        /** @var Collection<int, Blog> $blogs */
        $blogs = $this->blogRepository->all(['*'], ['category', 'media']);

        return $blogs;
    }

    /**
     * Create a new technical article from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated, ?UploadedFile $image = null): Blog
    {
        $blog = DB::transaction(function () use ($validated, $image): Blog {
            $nameArray = is_array($validated['name'] ?? null) ? $validated['name'] : [];
            $slugSource = isset($validated['slug']) && trim((string) $validated['slug']) !== ''
                ? trim((string) $validated['slug'])
                : (string) ($nameArray['en'] ?? $nameArray['ar'] ?? 'article');

            $validated['slug'] = $this->slugGenerator->generate($this->blogRepository, $slugSource);
            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->blogRepository->nextSortOrder();

            $status = $validated['status'] ?? BlogStatusEnum::Published->value;
            $statusValue = $status instanceof BlogStatusEnum ? $status->value : (string) $status;
            $validated['status'] = $statusValue;

            if ($statusValue === BlogStatusEnum::Published->value && empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Blog $created */
            $created = $this->blogRepository->create($validated);

            if ($uploadedImage !== null) {
                $created->storeFile($uploadedImage);
            }

            return $created->load(['category', 'media']);
        });

        $this->flushCache();

        return $blog;
    }

    /**
     * Update an existing technical article from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Blog $blog, array $validated, ?UploadedFile $image = null): Blog
    {
        $updated = DB::transaction(function () use ($blog, $validated, $image): Blog {
            $nameArray = is_array($validated['name'] ?? null)
                ? $validated['name']
                : $blog->getTranslations('name');

            $slugSource = isset($validated['slug']) && trim((string) $validated['slug']) !== ''
                ? trim((string) $validated['slug'])
                : ($blog->slug ?: (string) ($nameArray['en'] ?? $nameArray['ar'] ?? 'article'));

            $validated['slug'] = $this->slugGenerator->generate(
                $this->blogRepository,
                $slugSource,
                $blog->id
            );

            if (isset($validated['status'])) {
                $statusValue = $validated['status'] instanceof BlogStatusEnum
                    ? $validated['status']->value
                    : (string) $validated['status'];
                $validated['status'] = $statusValue;

                if ($statusValue === BlogStatusEnum::Published->value && $blog->published_at === null && empty($validated['published_at'])) {
                    $validated['published_at'] = now();
                }
            }

            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Blog $saved */
            $saved = $this->blogRepository->update($blog, $validated);

            if ($uploadedImage !== null) {
                $saved->updateFile($uploadedImage);
            }

            return $saved->load(['category', 'media']);
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete a technical article and clear its media collection.
     */
    public function delete(Blog $blog): bool
    {
        $deleted = DB::transaction(function () use ($blog): bool {
            $blog->deleteFiles();

            return $this->blogRepository->delete($blog);
        });

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder articles by an array of IDs/sort items, or render legacy reorder view when passed a Model.
     *
     * @param  array<int, int|array{id: int, sort_order?: int, lft?: int, rgt?: int, depth?: int, parent_id?: int|null}>|Blog  $itemsOrModel
     */
    public function reorder(
        array|Blog $itemsOrModel,
        string $label = 'name',
        string $path = '',
        int $maxNum = 1
    ): mixed {
        if ($itemsOrModel instanceof Blog) {
            return ReorderHelper::reorder($itemsOrModel, $label, $path, $maxNum);
        }

        DB::transaction(function () use ($itemsOrModel): void {
            $this->blogRepository->reorder($itemsOrModel);
        });

        $this->flushCache();

        return null;
    }

    /**
     * Backward-compatible wrapper for Admin\BlogController::store.
     *
     * @param  array<string, mixed>  $data
     */
    public function createBlog(array $data): Blog
    {
        return $this->create($data);
    }

    /**
     * Backward-compatible wrapper for Admin\BlogController::update.
     *
     * @param  array<string, mixed>  $data
     */
    public function updateBlog(Blog $blog, array $data): Blog
    {
        return $this->update($blog, $data);
    }

    /**
     * Backward-compatible wrapper for Admin\BlogController::destroy.
     */
    public function deleteBlog(Blog $blog): bool
    {
        return $this->delete($blog);
    }

    /**
     * Backward-compatible wrapper for Admin\BlogController::saveReorder.
     */
    public function saveReorder(mixed $allEntries, Blog $blog): mixed
    {
        $result = ReorderHelper::saveReorder($allEntries, $blog);
        $this->flushCache();

        return $result;
    }

    /**
     * Flush cached blog and category query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([
            self::CACHE_MODULE,
            CategoryService::CACHE_MODULE,
        ]);
    }
}
