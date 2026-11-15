<?php

/**
 * UpdateServiceRequest
 *
 * Validates updating an existing software engineering service offering.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Service;

use App\Http\Requests\BasePortfolioFormRequest;
use App\Models\Service;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('services.edit');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $routeService = $this->route('service');
        $ignoreId = $routeService instanceof Service
            ? $routeService->id
            : (is_numeric($routeService) ? (int) $routeService : null);

        return [
            'title' => ['required', 'array'],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('services', 'slug')->ignore($ignoreId),
            ],
            'subtitle' => ['nullable', 'array'],
            'subtitle.ar' => ['nullable', 'string', 'max:255'],
            'subtitle.en' => ['nullable', 'string', 'max:255'],
            'short_description' => ['required', 'array'],
            'short_description.ar' => ['required', 'string', 'max:1000'],
            'short_description.en' => ['required', 'string', 'max:1000'],
            'description' => ['required', 'array'],
            'description.ar' => ['required', 'string'],
            'description.en' => ['required', 'string'],
            'features' => ['nullable', 'array'],
            'features.ar' => ['nullable', 'string'],
            'features.en' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:150'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ];
    }
}

