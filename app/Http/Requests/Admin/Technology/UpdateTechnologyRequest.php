<?php

/**
 * UpdateTechnologyRequest
 *
 * Validates updating an existing technical stack item.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Technology;

use App\Enums\TechnologyCategoryEnum;
use App\Http\Requests\BasePortfolioFormRequest;
use App\Models\Technology;
use Illuminate\Validation\Rule;

class UpdateTechnologyRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('technologies.edit');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $routeTechnology = $this->route('technology');
        $ignoreId = $routeTechnology instanceof Technology
            ? $routeTechnology->id
            : (is_numeric($routeTechnology) ? (int) $routeTechnology : null);

        return [
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:150'],
            'name.en' => ['required', 'string', 'max:150'],
            'slug' => [
                'nullable',
                'string',
                'max:150',
                Rule::unique('technologies', 'slug')->ignore($ignoreId),
            ],
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
