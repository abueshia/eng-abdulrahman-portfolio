<?php

/**
 * TechnologyViewModel
 *
 * Supplies form state, route action/method, and TechnologyCategoryEnum options
 * to the Admin Technology create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Enums\TechnologyCategoryEnum;
use App\Models\Technology;
use Spatie\ViewModels\ViewModel;

class TechnologyViewModel extends ViewModel
{
    public Technology $technology;

    public function __construct(?Technology $technology = null)
    {
        $this->technology = $technology ?? new Technology([
            'proficiency_percent' => 90,
            'years_of_experience' => 4,
            'is_active' => true,
        ]);
    }

    public function action(): string
    {
        return $this->technology->exists
            ? route('admin.technology.update', ['technology' => $this->technology->id])
            : route('admin.technology.store');
    }

    public function method(): string
    {
        return $this->technology->exists ? 'PUT' : 'POST';
    }

    /**
     * @return array<string, string>
     */
    public function categories(): array
    {
        return TechnologyCategoryEnum::options();
    }
}

