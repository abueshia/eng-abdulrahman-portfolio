<?php

/**
 * TestimonialRepositoryInterface
 *
 * Contract for reading and persisting client testimonials and reviews.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Testimonial;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TestimonialRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all active testimonials with project and media eager loaded.
     *
     * @return Collection<int, Testimonial>
     */
    public function getActive(): Collection;

    /**
     * Get the featured active testimonials.
     *
     * @return Collection<int, Testimonial>
     */
    public function getFeatured(int $limit = 6): Collection;

    /**
     * Get the active testimonials linked to a project.
     *
     * @return Collection<int, Testimonial>
     */
    public function getByProject(int $projectId): Collection;

    /**
     * Count the active testimonials.
     */
    public function countActive(): int;

    /**
     * Get the average rating (0.0 when there are no active testimonials).
     */
    public function averageRating(): float;

    /**
     * Paginate testimonials for the admin dashboard.
     *
     * @param  array{search?: string|null, rating?: int|string|null}  $filters
     * @return LengthAwarePaginator<Testimonial>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
