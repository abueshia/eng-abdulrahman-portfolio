<?php

/**
 * FaqRepositoryInterface
 *
 * Contract for reading and persisting frequently asked questions.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Faq;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface FaqRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all active FAQs.
     *
     * @return Collection<int, Faq>
     */
    public function getActive(): Collection;

    /**
     * Get the active FAQs of a category (e.g. `general`, `pricing`).
     *
     * @return Collection<int, Faq>
     */
    public function getByCategory(string $category): Collection;

    /**
     * Paginate FAQs for the admin dashboard.
     *
     * @param  array{search?: string|null, category?: string|null}  $filters
     * @return LengthAwarePaginator<Faq>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
