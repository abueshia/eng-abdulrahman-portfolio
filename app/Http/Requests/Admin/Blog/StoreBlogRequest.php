<?php

/**
 * StoreBlogRequest
 *
 * Validates creation of a new bilingual technical article (Blog).
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Blog;

use App\Enums\BlogStatusEnum;
use App\Http\Requests\BasePortfolioFormRequest;
use Illuminate\Validation\Rule;

class StoreBlogRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('blogs.create');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:255'],
            'name.en' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blogs,slug'],
            'short_description' => ['nullable', 'array'],
            'short_description.ar' => ['nullable', 'string', 'max:1000'],
            'short_description.en' => ['nullable', 'string', 'max:1000'],
            'description' => ['required', 'array'],
            'description.ar' => ['required', 'string'],
            'description.en' => ['required', 'string'],
            'meta_title' => ['nullable', 'array'],
            'meta_title.ar' => ['nullable', 'string', 'max:255'],
            'meta_title.en' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'array'],
            'meta_description.ar' => ['nullable', 'string', 'max:500'],
            'meta_description.en' => ['nullable', 'string', 'max:500'],
            'meta_tags' => ['nullable', 'string', 'max:500'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'reading_time_minutes' => ['nullable', 'integer', 'min:1', 'max:240'],
            'status' => ['required', Rule::enum(BlogStatusEnum::class)],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
        ];
    }
}
