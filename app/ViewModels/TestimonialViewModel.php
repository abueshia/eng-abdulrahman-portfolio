<?php

/**
 * TestimonialViewModel
 *
 * Supplies form state, route action/method, and published projects list
 * to the Admin Testimonial create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Project;
use App\Models\Testimonial;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class TestimonialViewModel extends ViewModel
{
    public Testimonial $testimonial;

    public function __construct(?Testimonial $testimonial = null)
    {
        $this->testimonial = $testimonial ?? new Testimonial([
            'rating' => 5,
            'is_active' => true,
            'is_featured' => false,
        ]);
    }

    public function action(): string
    {
        return $this->testimonial->exists
            ? route('admin.testimonial.update', ['testimonial' => $this->testimonial->id])
            : route('admin.testimonial.store');
    }

    public function method(): string
    {
        return $this->testimonial->exists ? 'PUT' : 'POST';
    }

    /**
     * @return Collection<int, Project>
     */
    public function projects(): Collection
    {
        /** @var ProjectRepositoryInterface $projectRepository */
        $projectRepository = app(ProjectRepositoryInterface::class);

        return $projectRepository->getPublished();
    }
}
