<?php

/**
 * UpdateExperienceRequest
 *
 * Validates updating an existing professional career experience entry.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Experience;

use App\Enums\EmploymentTypeEnum;
use App\Http\Requests\BasePortfolioFormRequest;
use Illuminate\Validation\Rule;

class UpdateExperienceRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('experiences.edit');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'company_name' => ['required', 'array'],
            'company_name.ar' => ['required', 'string', 'max:255'],
            'company_name.en' => ['required', 'string', 'max:255'],
            'role_title' => ['required', 'array'],
            'role_title.ar' => ['required', 'string', 'max:255'],
            'role_title.en' => ['required', 'string', 'max:255'],
            'employment_type' => ['required', Rule::enum(EmploymentTypeEnum::class)],
            'location' => ['nullable', 'array'],
            'location.ar' => ['nullable', 'string', 'max:255'],
            'location.en' => ['nullable', 'string', 'max:255'],
            'company_url' => ['nullable', 'url', 'max:500'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current' => ['nullable', 'boolean'],
            'summary' => ['required', 'array'],
            'summary.ar' => ['required', 'string'],
            'summary.en' => ['required', 'string'],
            'achievements' => ['nullable', 'array'],
            'achievements.ar' => ['nullable', 'string'],
            'achievements.en' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['integer', 'exists:technologies,id'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ];
    }
}

