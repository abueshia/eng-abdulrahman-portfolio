<?php

/**
 * TestimonialService
 *
 * Manages client testimonials and reviews, avatar uploads, reordering,
 * and cache invalidation.
 */

declare(strict_types=1);

namespace App\Services;

use App\Helpers\ReorderHelper;
use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use App\Services\Support\PortfolioCache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class TestimonialService
{
    public const CACHE_MODULE = 'testimonials';

    private readonly TestimonialRepositoryInterface $testimonialRepository;

    private readonly PortfolioCache $cache;

    public function __construct(
        ?TestimonialRepositoryInterface $testimonialRepository = null,
        ?PortfolioCache $cache = null,
    ) {
        $this->testimonialRepository = $testimonialRepository ?? app(TestimonialRepositoryInterface::class);
        $this->cache = $cache ?? app(PortfolioCache::class);
    }

    /**
     * Get active testimonials ordered by sort_order with project and media (cached).
     *
     * @return Collection<int, Testimonial>
     */
    public function getActive(?int $limit = null): Collection
    {
        $variant = 'active:'.($limit ?? 'all');

        /** @var Collection<int, Testimonial> $testimonials */
        $testimonials = $this->cache->remember(
            self::CACHE_MODULE,
            $variant,
            fn (): Collection => $this->testimonialRepository->getActive($limit),
        );

        return $testimonials;
    }

    /**
     * Get featured active testimonials (cached).
     *
     * @return Collection<int, Testimonial>
     */
    public function getFeatured(int $limit = 6): Collection
    {
        /** @var Collection<int, Testimonial> $testimonials */
        $testimonials = $this->cache->remember(
            self::CACHE_MODULE,
            "featured:{$limit}",
            fn (): Collection => $this->testimonialRepository->getFeatured($limit),
        );

        return $testimonials;
    }

    /**
     * Paginate testimonials for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->testimonialRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Build an ordered Eloquent query with eager-loaded relations for Admin Yajra DataTables.
     *
     * @return Builder<Testimonial>
     */
    public function getAdminDataTableQuery(): Builder
    {
        /** @var Builder<Testimonial> $query */
        $query = $this->testimonialRepository->adminQuery(['project', 'media']);

        return $query;
    }

    /**
     * Get all testimonials ordered by sort_order for the Admin drag-and-drop reorder screen.
     *
     * @return Collection<int, Testimonial>
     */
    public function getAllForReorder(): Collection
    {
        /** @var Collection<int, Testimonial> $testimonials */
        $testimonials = $this->testimonialRepository->all(['*'], ['project', 'media']);

        return $testimonials;
    }

    /**
     * Count active testimonials.
     */
    public function countActive(): int
    {
        return $this->testimonialRepository->countActive();
    }

    /**
     * Get average testimonial rating.
     */
    public function averageRating(): float
    {
        return $this->testimonialRepository->averageRating();
    }

    /**
     * Create a new testimonial from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated, ?UploadedFile $image = null): Testimonial
    {
        $testimonial = DB::transaction(function () use ($validated, $image): Testimonial {
            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->testimonialRepository->nextSortOrder();

            /** @var Testimonial $created */
            $created = $this->testimonialRepository->create($validated);

            if ($uploadedImage !== null) {
                $created->storeFile($uploadedImage);
            }

            return $created->load(['project', 'media']);
        });

        $this->flushCache();

        return $testimonial;
    }

    /**
     * Update an existing testimonial from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Testimonial $testimonial, array $validated, ?UploadedFile $image = null): Testimonial
    {
        $updated = DB::transaction(function () use ($testimonial, $validated, $image): Testimonial {
            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Testimonial $saved */
            $saved = $this->testimonialRepository->update($testimonial, $validated);

            if ($uploadedImage !== null) {
                $saved->updateFile($uploadedImage);
            }

            return $saved->load(['project', 'media']);
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete a testimonial and clear its media collection.
     */
    public function delete(Testimonial $testimonial): bool
    {
        $deleted = DB::transaction(function () use ($testimonial): bool {
            $testimonial->deleteFiles();

            return $this->testimonialRepository->delete($testimonial);
        });

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder testimonials by an array of IDs/sort items, or render legacy reorder view when passed a Model.
     *
     * @param  array<int, int|array{id: int, sort_order?: int, lft?: int, rgt?: int, depth?: int, parent_id?: int|null}>|Testimonial  $itemsOrModel
     */
    public function reorder(
        array|Testimonial $itemsOrModel,
        string $label = 'name',
        string $path = '',
        int $maxNum = 1
    ): mixed {
        if ($itemsOrModel instanceof Testimonial) {
            return ReorderHelper::reorder($itemsOrModel, $label, $path, $maxNum);
        }

        DB::transaction(function () use ($itemsOrModel): void {
            $this->testimonialRepository->reorder($itemsOrModel);
        });

        $this->flushCache();

        return null;
    }

    /**
     * Backward-compatible wrapper for Admin\TestimonialController::store.
     *
     * @param  array<string, mixed>  $data
     */
    public function createTestimonial(array $data): Testimonial
    {
        return $this->create($data);
    }

    /**
     * Backward-compatible wrapper for Admin\TestimonialController::update.
     *
     * @param  array<string, mixed>  $data
     */
    public function updateTestimonial(Testimonial $testimonial, array $data): Testimonial
    {
        return $this->update($testimonial, $data);
    }

    /**
     * Backward-compatible wrapper for Admin\TestimonialController::destroy.
     */
    public function deleteTestimonial(Testimonial $testimonial): bool
    {
        return $this->delete($testimonial);
    }

    /**
     * Backward-compatible wrapper for Admin\TestimonialController::saveReorder.
     */
    public function saveReorder(mixed $allEntries, Testimonial $testimonial): mixed
    {
        $result = ReorderHelper::saveReorder($allEntries, $testimonial);
        $this->flushCache();

        return $result;
    }

    /**
     * Flush cached testimonial and project query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([
            self::CACHE_MODULE,
            ProjectService::CACHE_MODULE,
        ]);
    }
}
