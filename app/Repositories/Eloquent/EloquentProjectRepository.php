<?php

/**
 * EloquentProjectRepository
 *
 * Eloquent implementation of ProjectRepositoryInterface. All read methods eager load
 * category, technologies and media to prevent N+1 queries.
 */

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    /**
     * Relations eager loaded for project listings (cards).
     *
     * @var array<int, string>
     */
    private const LIST_RELATIONS = ['category', 'technologies.media', 'media'];

    /**
     * Initialize the repository with the Project model.
     */
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritDoc}
     */
    public function getPublished(): Collection
    {
        /** @var Collection<int, Project> $projects */
        $projects = $this->listQuery()->published()->ordered()->get();

        return $projects;
    }

    /**
     * {@inheritDoc}
     */
    public function getFeatured(int $limit = 6): Collection
    {
        /** @var Collection<int, Project> $projects */
        $projects = $this->listQuery()
            ->published()
            ->featured()
            ->ordered()
            ->limit($limit)
            ->get();

        return $projects;
    }

    /**
     * {@inheritDoc}
     */
    public function getByType(ProjectTypeEnum $type): Collection
    {
        /** @var Collection<int, Project> $projects */
        $projects = $this->listQuery()->published()->ofType($type)->ordered()->get();

        return $projects;
    }

    /**
     * {@inheritDoc}
     */
    public function getByCategory(int $categoryId): Collection
    {
        /** @var Collection<int, Project> $projects */
        $projects = $this->listQuery()
            ->published()
            ->where('category_id', $categoryId)
            ->ordered()
            ->get();

        return $projects;
    }

    /**
     * {@inheritDoc}
     */
    public function paginatePublished(
        int $perPage = 9,
        ?ProjectTypeEnum $type = null,
        ?int $categoryId = null
    ): LengthAwarePaginator {
        return $this->listQuery()
            ->published()
            ->when($type !== null, fn (Builder $query) => $query->ofType($type))
            ->when($categoryId !== null, fn (Builder $query) => $query->where('category_id', $categoryId))
            ->ordered()
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function findBySlugWithRelations(string $slug, bool $onlyPublished = true): Project
    {
        /** @var Project $project */
        $project = $this->query()
            ->with([
                'category',
                'technologies.media',
                'media',
                'testimonials' => fn ($query) => $query->active()->ordered()->with('media'),
            ])
            ->when($onlyPublished, fn (Builder $query) => $query->published())
            ->where('slug', $slug)
            ->firstOrFail();

        return $project;
    }

    /**
     * {@inheritDoc}
     */
    public function getRelated(Project $project, int $limit = 3): Collection
    {
        $technologyIds = $project->technologies()->pluck('technologies.id')->all();

        /** @var Collection<int, Project> $projects */
        $projects = $this->listQuery()
            ->published()
            ->whereKeyNot($project->getKey())
            ->where(function (Builder $query) use ($project, $technologyIds): void {
                if ($project->category_id !== null) {
                    $query->orWhere('category_id', $project->category_id);
                }

                if ($technologyIds !== []) {
                    $query->orWhereHas(
                        'technologies',
                        fn (Builder $technologies) => $technologies->whereIn('technologies.id', $technologyIds)
                    );
                }

                if ($project->category_id === null && $technologyIds === []) {
                    $query->whereRaw('1 = 0');
                }
            })
            ->ordered()
            ->limit($limit)
            ->get();

        return $projects;
    }

    /**
     * {@inheritDoc}
     */
    public function paginateForAdmin(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->query()->with(['category', 'media']);

        $this->applySearch($query, $filters['search'] ?? null, ['title'], ['slug']);

        return $query
            ->when(
                ! empty($filters['status']),
                fn (Builder $builder) => $builder->where('status', ProjectStatusEnum::from((string) $filters['status'])->value)
            )
            ->when(
                ! empty($filters['type']),
                fn (Builder $builder) => $builder->ofType(ProjectTypeEnum::from((string) $filters['type']))
            )
            ->ordered()
            ->paginate($perPage);
    }

    /**
     * {@inheritDoc}
     */
    public function getLatestForAdmin(int $limit = 5): Collection
    {
        /** @var Collection<int, Project> $projects */
        $projects = $this->listQuery()
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit($limit)
            ->get();

        return $projects;
    }

    /**
     * {@inheritDoc}
     */
    public function syncTechnologies(Project $project, array $technologies): void
    {
        $payload = [];
        $position = 1;

        foreach ($technologies as $key => $technology) {
            if (is_int($technology) || is_numeric($technology)) {
                $payload[(int) $technology] = [
                    'role_in_project' => null,
                    'sort_order' => $position,
                ];
            } elseif (is_array($technology)) {
                $techId = isset($technology['id']) ? (int) $technology['id'] : (int) $key;
                if ($techId > 0) {
                    $payload[$techId] = [
                        'role_in_project' => $technology['role_in_project'] ?? null,
                        'sort_order' => (int) ($technology['sort_order'] ?? $position),
                    ];
                }
            }
            $position++;
        }

        $project->technologies()->sync($payload);
    }

    /**
     * Start a query with the listing relations eager loaded.
     *
     * @return Builder<Project>
     */
    private function listQuery(): Builder
    {
        /** @var Builder<Project> $query */
        $query = $this->query()->with(self::LIST_RELATIONS);

        return $query;
    }
}
