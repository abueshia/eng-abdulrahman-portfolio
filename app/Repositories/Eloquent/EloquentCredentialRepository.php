<?php

/**
 * EloquentCredentialRepository
 *
 * Eloquent implementation of CredentialRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\CredentialTypeEnum;
use App\Models\Credential;
use App\Repositories\Contracts\CredentialRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;

class EloquentCredentialRepository extends BaseRepository implements CredentialRepositoryInterface
{
    /**
     * Initialize the repository with the Credential model.
     */
    public function __construct(Credential $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Credential> $credentials */
        $credentials = $this->query()->with('media')->active()->ordered()->get();

        return $credentials;
    }

    /**
     * {@inheritDoc}
     */
    public function getByType(CredentialTypeEnum $type): Collection
    {
        /** @var Collection<int, Credential> $credentials */
        $credentials = $this->query()->with('media')->active()->ofType($type)->ordered()->get();

        return $credentials;
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupedByType(): SupportCollection
    {
        return $this->getActive()->groupBy(
            static fn (Credential $credential): string => $credential->type->value
        );
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query()->with('media');

        $this->applySearch($query, $filters['search'] ?? null, ['title', 'organization']);

        return $query
            ->when(
                ! empty($filters['type']),
                fn (Builder $builder) => $builder->ofType(CredentialTypeEnum::from((string) $filters['type']))
            )
            ->ordered()
            ->paginate($perPage);
    }
}
