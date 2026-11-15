<?php

/**
 * CategoryViewModel
 *
 * Supplies form state and route action/method to the Admin Category create/edit form view.
 */

declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Category;
use Spatie\ViewModels\ViewModel;

class CategoryViewModel extends ViewModel
{
    public Category $category;

    public function __construct(?Category $category = null)
    {
        $this->category = $category ?? new Category([
            'is_active' => true,
        ]);
    }

    public function action(): string
    {
        return $this->category->exists
            ? route('admin.category.update', ['category' => $this->category->id])
            : route('admin.category.store');
    }

    public function method(): string
    {
        return $this->category->exists ? 'PUT' : 'POST';
    }
}
