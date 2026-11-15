<?php

/**
 * UpdateProjectRequest
 *
 * Validates updating an existing portfolio project or case study.
 */

declare(strict_types=1);

namespace App\Http\Requests\Admin\Project;

use App\DTOs\ProjectData;
use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Http\Requests\BasePortfolioFormRequest;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends BasePortfolioFormRequest
{
    public function authorize(): bool
    {
        return $this->authorizeAdminPermission('projects.edit');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $routeProject = $this->route('project');
        $ignoreId = $routeProject instanceof Project
            ? $routeProject->id
            : (is_numeric($routeProject) ? (int) $routeProject : null);

        return [
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'title' => ['required', 'array'],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('projects', 'slug')->ignore($ignoreId),
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
            'challenge' => ['nullable', 'array'],
            'challenge.ar' => ['nullable', 'string'],
            'challenge.en' => ['nullable', 'string'],
            'solution' => ['nullable', 'array'],
            'solution.ar' => ['nullable', 'string'],
            'solution.en' => ['nullable', 'string'],
            'results' => ['nullable', 'array'],
            'results.ar' => ['nullable', 'string'],
            'results.en' => ['nullable', 'string'],
            'client_name' => ['nullable', 'array'],
            'client_name.ar' => ['nullable', 'string', 'max:255'],
            'client_name.en' => ['nullable', 'string', 'max:255'],
            'role_title' => ['nullable', 'array'],
            'role_title.ar' => ['nullable', 'string', 'max:255'],
            'role_title.en' => ['nullable', 'string', 'max:255'],
            'project_type' => ['required', Rule::enum(ProjectTypeEnum::class)],
            'status' => ['required', Rule::enum(ProjectStatusEnum::class)],
            'live_url' => ['nullable', 'url', 'max:500'],
            'repo_url' => ['nullable', 'url', 'max:500'],
            'video_url' => ['nullable', 'url', 'max:500'],
            'completed_at' => ['nullable', 'date'],
            'duration' => ['nullable', 'array'],
            'duration.ar' => ['nullable', 'string', 'max:120'],
            'duration.en' => ['nullable', 'string', 'max:120'],
            'metrics' => ['nullable', 'array'],
            'meta_title' => ['nullable', 'array'],
            'meta_title.ar' => ['nullable', 'string', 'max:255'],
            'meta_title.en' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'array'],
            'meta_description.ar' => ['nullable', 'string', 'max:500'],
            'meta_description.en' => ['nullable', 'string', 'max:500'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'technologies' => ['nullable', 'array'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['file', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120'],
            'replace_gallery' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Convert validated request data and uploaded files into a ProjectData DTO.
     */
    public function toDto(): ProjectData
    {
        /** @var array<int, UploadedFile> $galleryFiles */
        $galleryFiles = $this->hasFile('gallery')
            ? (array) $this->file('gallery')
            : [];

        return ProjectData::fromArray(
            validated: $this->validated(),
            coverImage: $this->file('image'),
            galleryImages: $galleryFiles,
        );
    }
}
