<?php

/**
 * EloquentExperienceRepository
 *
 * Eloquent implementation of ExperienceRepositoryInterface.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\EmploymentTypeEnum;
use App\Models\Experience;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentExperienceRepository extends BaseRepository implements ExperienceRepositoryInterface
{
    /**
     * Relations eager loaded for experience reads.
     *
     * @var array<int, string>
     */
    private const RELATIONS = ['technologies.media', 'media'];

    /**
     * Initialize the repository with the Experience model.
     */
    public function __construct(Experience $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getActive(): Collection
    {
        /** @var Collection<int, Experience> $experiences */
        $experiences = $this->query()->with(self::RELATIONS)->active()->ordered()->get();

        return $experiences;
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrent(): Collection
    {
        /** @var Collection<int, Experience> $experiences */
        $experiences = $this->query()
            ->with(self::RELATIONS)
            ->active()
            ->where('is_current', true)
            ->ordered()
            ->get();

        return $experiences;
    }

    /**
     * {@inheritDoc}
     */
    public function findByIdWithRelations(int $id): Experience
    {
        /** @var Experience $experience */
        $experience = $this->findById($id, self::RELATIONS);

        return $experience;
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query()->with('media');

        $this->applySearch($query, $filters['search'] ?? null, ['company_name', 'role_title']);

        return $query
            ->when(
                ! empty($filters['employment_type']),
                fn (Builder $builder) => $builder->where(
                    'employment_type',
                    EmploymentTypeEnum::from((string) $filters['employment_type'])->value
                )
            )
            ->ordered()
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function syncTechnologies(Experience $experience, array $technologyIds): void
    {
        $experience->technologies()->sync(array_map('intval', array_values($technologyIds)));
    }
}
