<?php

/**
 * StoreTechnologyRequest
 *
 * Validates creation of a new technical stack item (language, framework, tool).
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Technology;

use App\Enums\TechnologyCategoryEnum;
use App\Http\Requests\BasePortfolioFormRequest;
use Illuminate\Validation\Rule;

class StoreTechnologyRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('technologies.create');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:150'],
            'name.en' => ['required', 'string', 'max:150'],
            'slug' => ['nullable', 'string', 'max:150', 'unique:technologies,slug'],
            'category' => ['required', Rule::enum(TechnologyCategoryEnum::class)],
            'icon' => ['nullable', 'string', 'max:150'],
            'badge_color' => ['nullable', 'string', 'max:60'],
            'proficiency_percent' => ['required', 'integer', 'min:1', 'max:100'],
            'years_of_experience' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ];
    }
}

