<?php

/**
 * CredentialService
 *
 * Manages academic degrees, professional certifications, specialized courses,
 * and awards, including certificate media uploads, reordering, and caching.
 */

declare(strict_types=1);

namespace App\Services;

use App\Enums\CredentialTypeEnum;
use App\Models\Credential;
use App\Repositories\Contracts\CredentialRepositoryInterface;
use App\Services\Support\PortfolioCache;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CredentialService
{
    public const CACHE_MODULE = 'credentials';

    public function __construct(
        private readonly CredentialRepositoryInterface $credentialRepository,
        private readonly PortfolioCache $cache,
    ) {}

    /**
     * Get active credentials ordered by sort_order and issue date (cached).
     *
     * @return Collection<int, Credential>
     */
    public function getActive(?CredentialTypeEnum $type = null): Collection
    {
        $variant = 'active:'.($type?->value ?? 'all');

        /** @var Collection<int, Credential> $credentials */
        $credentials = $this->cache->remember(
            self::CACHE_MODULE,
            $variant,
            fn (): Collection => $type !== null
                ? $this->credentialRepository->getByType($type)
                : $this->credentialRepository->getActive(),
        );

        return $credentials;
    }

    /**
     * Paginate credentials for the Admin Dashboard.
     *
     * @param  array<string, mixed>  $filters
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->credentialRepository->paginateForAdmin($perPage, $filters);
    }

    /**
     * Create a new credential from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated, ?UploadedFile $image = null): Credential
    {
        $credential = DB::transaction(function () use ($validated, $image): Credential {
            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            $validated['sort_order'] = isset($validated['sort_order']) && $validated['sort_order'] !== ''
                ? (int) $validated['sort_order']
                : $this->credentialRepository->nextSortOrder();

            /** @var Credential $created */
            $created = $this->credentialRepository->create($validated);

            if ($uploadedImage !== null) {
                $created->storeFile($uploadedImage);
            }

            return $created->load('media');
        });

        $this->flushCache();

        return $credential;
    }

    /**
     * Update an existing credential from validated data.
     *
     * @param  array<string, mixed>  $validated
     */
    public function update(Credential $credential, array $validated, ?UploadedFile $image = null): Credential
    {
        $updated = DB::transaction(function () use ($credential, $validated, $image): Credential {
            $uploadedImage = $image ?? (isset($validated['image']) && $validated['image'] instanceof UploadedFile ? $validated['image'] : null);
            unset($validated['image']);

            /** @var Credential $saved */
            $saved = $this->credentialRepository->update($credential, $validated);

            if ($uploadedImage !== null) {
                $saved->updateFile($uploadedImage);
            }

            return $saved->load('media');
        });

        $this->flushCache();

        return $updated;
    }

    /**
     * Delete a credential and clear its media collection.
     */
    public function delete(Credential $credential): bool
    {
        $deleted = DB::transaction(function () use ($credential): bool {
            $credential->deleteFiles();

            return $this->credentialRepository->delete($credential);
        });

        $this->flushCache();

        return $deleted;
    }

    /**
     * Reorder credentials.
     *
     * @param  array<int, int|array{id: int, sort_order?: int}>  $items
     */
    public function reorder(array $items): void
    {
        DB::transaction(function () use ($items): void {
            $this->credentialRepository->reorder($items);
        });

        $this->flushCache();
    }

    /**
     * Flush cached credential query results.
     */
    public function flushCache(): void
    {
        $this->cache->flush([self::CACHE_MODULE]);
    }
}
