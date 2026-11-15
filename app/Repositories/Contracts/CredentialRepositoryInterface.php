<?php

/**
 * CredentialRepositoryInterface
 *
 * Contract for reading and persisting academic degrees, certificates, courses and awards.
 */

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Enums\CredentialTypeEnum;
use App\Models\Credential;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CredentialRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all active credentials with media eager loaded.
     *
     * @return Collection<int, Credential>
     */
    public function getActive(): Collection;

    /**
     * Get the active credentials of a type.
     *
     * @return Collection<int, Credential>
     */
    public function getByType(CredentialTypeEnum $type): Collection;

    /**
     * Get active credentials grouped by their type value.
     *
     * @return \Illuminate\Support\Collection<string, Collection<int, Credential>>
     */
    public function getGroupedByType(): \Illuminate\Support\Collection;

    /**
     * Paginate credentials for the admin dashboard.
     *
     * @param  array{search?: string|null, type?: string|null}  $filters
     * @return LengthAwarePaginator<Credential>
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
