<?php

/**
 * FaqService
 *
 * Manages bilingual Frequently Asked Questions, reordering, and cache invalidation.
 */

declare(strict_types=1);

namespace App\Services;

use App\Models\Faq;
use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Services\Support\PortfolioCache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FaqService
{
    public const CACHE_MODULE = 'faqs';

    public function __construct(
        private readonly FaqRepositoryInterface $faqRepository,
        private readonly PortfolioCache $cache,
    ) {}

    /**
     * Get all active FAQs ordered by sort_order (cached).
     *
     * @return Collection<int, Faq>
     */
    public function getActive(?string $category = null): Collection
    {
        $variant = 'active:'.($category ?? 'all');

        /** @var Collection<int, Faq> $faqs */
        $faqs = $this->cache->remember(
            self::CACHE_MODULE,
            $variant,
            fn (): Collection => $category !== null
                ? $this->faqRepository->getByCategory($category)
                : $this->faqRepository->getActive(),
        );

        return $faqs;
    }

    /**
     * Paginate FAQs for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->faqRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Create a new FAQ from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated): Faq
    {
        $faq = DB::transaction(function () use ($validated): Faq {
            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->faqRepository->nextSortOrder();

            /** @var Faq $created */
            $created = $this->faqRepository->create($validated);

            return $created;
        });

        $this->flushCache();

        return $faq;
    }

    /**
     * Update an existing FAQ from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Faq $faq, array $validated): Faq
    {
        $updated = DB::transaction(function () use ($faq, $validated): Faq {
            /** @var Faq $saved */
            $saved = $this->faqRepository->update($faq, $validated);

            return $saved;
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete an FAQ.
     */
    public function delete(Faq $faq): bool
    {
        $deleted = DB::transaction(
            fn (): bool => $this->faqRepository->delete($faq)
        );

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder FAQs.
     *
     * @param  array<int, int|array{id: int, sort_order?: int}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->faqRepository->reorder($items);
        });

        $this->flushCache();
    }

    /**
     * Flush cached FAQ query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([self::CACHE_MODULE]);
    }
}
