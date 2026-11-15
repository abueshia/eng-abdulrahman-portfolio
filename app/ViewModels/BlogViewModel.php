<?php

/**
 * BlogViewModel
 *
 * Supplies form state, route action/method, active categories, and BlogStatusEnum
 * options to the Admin Blog create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Enums\BlogStatusEnum;
use App\Models\Blog;
use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class BlogViewModel extends ViewModel
{
    public Blog $blog;

    public function __construct(?Blog $blog = null)
    {
        $this->blog = $blog ?? new Blog([
            'reading_time_minutes' => 5,
            'is_active' => true,
            'is_featured' => false,
        ]);
    }

    public function action(): string
    {
        return $this->blog->exists
            ? route('admin.blog.update', ['blog' => $this->blog->id])
            : route('admin.blog.store');
    }

    public function method(): string
    {
        return $this->blog->exists ? 'PUT' : 'POST';
    }

    /**
     * @return Collection<int, Category>
     */
    public function categories(): Collection
    {
        /** @var CategoryRepositoryInterface $categoryRepository */
        $categoryRepository = app(CategoryRepositoryInterface::class);

        return $categoryRepository->getActive();
    }

    /**
     * @return array<string, string>
     */
    public function blogStatuses(): array
    {
        return BlogStatusEnum::options();
    }
}
