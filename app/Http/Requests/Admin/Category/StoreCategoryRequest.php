<?php

/**
 * StoreCategoryRequest
 *
 * Validates creation of a new bilingual project/article category.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\BasePortfolioFormRequest;

class StoreCategoryRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('categories.create');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:255'],
            'name.en' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug'],
            'description' => ['nullable', 'array'],
            'description.ar' => ['nullable', 'string'],
            'description.en' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'array'],
            'meta_title.ar' => ['nullable', 'string', 'max:255'],
            'meta_title.en' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'array'],
            'meta_description.ar' => ['nullable', 'string', 'max:500'],
            'meta_description.en' => ['nullable', 'string', 'max:500'],
            'meta_tags' => ['nullable', 'string', 'max:500'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ];
    }
}
