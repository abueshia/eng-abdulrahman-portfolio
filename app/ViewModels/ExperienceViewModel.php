<?php

/**
 * ExperienceViewModel
 *
 * Supplies form state, route action/method, EmploymentTypeEnum options, and
 * active technologies to the Admin Experience create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Enums\EmploymentTypeEnum;
use App\Models\Experience;
use App\Models\Technology;
use App\Repositories\Contracts\TechnologyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class ExperienceViewModel extends ViewModel
{
    public Experience $experience;

    public function __construct(?Experience $experience = null)
    {
        $this->experience = $experience ?? new Experience([
            'is_active' => true,
            'is_current' => false,
        ]);
    }

    public function action(): string
    {
        return $this->experience->exists
            ? route('admin.experience.update', ['experience' => $this->experience->id])
            : route('admin.experience.store');
    }

    public function method(): string
    {
        return $this->experience->exists ? 'PUT' : 'POST';
    }

    /**
     * @return array<string, string>
     */
    public function employmentTypes(): array
    {
        return EmploymentTypeEnum::options();
    }

    /**
     * @return Collection<int, Technology>
     */
    public function technologies(): Collection
    {
        /** @var TechnologyRepositoryInterface $technologyRepository */
        $technologyRepository = app(TechnologyRepositoryInterface::class);

        return $technologyRepository->getActive();
    }

    /**
     * @return array<int, int>
     */
    public function selectedTechnologyIds(): array
    {
        if (! $this->experience->exists) {
            return [];
        }

        return $this->experience->technologies
            ->pluck('id')
            ->map(static fn (mixed $id): int => (int) $id)
            ->all();
    }
}
