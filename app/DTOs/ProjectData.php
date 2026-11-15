<?php

/**
 * ProjectData DTO
 *
 * Immutable Data Transfer Object encapsulating validated project and case-study
 * attributes, technology pivot mappings, and uploaded media files.
 */

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use Illuminate\Http\UploadedFile;

readonly class ProjectData
{
    /**
     * @param  array<string, string|null>  $title
     * @param  array<string, string|null>  $subtitle
     * @param  array<string, string|null>  $shortDescription
     * @param  array<string, string|null>  $description
     * @param  array<string, string|null>  $challenge
     * @param  array<string, string|null>  $solution
     * @param  array<string, string|null>  $results
     * @param  array<string, string|null>  $clientName
     * @param  array<string, string|null>  $roleTitle
     * @param  array<string, string|null>  $duration
     * @param  array<int|string, mixed>  $metrics
     * @param  array<string, string|null>  $metaTitle
     * @param  array<string, string|null>  $metaDescription
     * @param  array<int|string, int|array{role_in_project?: string|null, sort_order?: int}>  $technologies
     * @param  array<int, UploadedFile>  $galleryImages
     */
    public function __construct(
        public array $title,
        public ?int $categoryId = null,
        public ?string $slug = null,
        public array $subtitle = [],
        public array $shortDescription = [],
        public array $description = [],
        public array $challenge = [],
        public array $solution = [],
        public array $results = [],
        public array $clientName = [],
        public array $roleTitle = [],
        public ProjectTypeEnum $projectType = ProjectTypeEnum::WebApp,
        public ProjectStatusEnum $status = ProjectStatusEnum::Published,
        public ?string $liveUrl = null,
        public ?string $repoUrl = null,
        public ?string $videoUrl = null,
        public ?string $completedAt = null,
        public array $duration = [],
        public array $metrics = [],
        public array $metaTitle = [],
        public array $metaDescription = [],
        public bool $isFeatured = false,
        public bool $isActive = true,
        public ?int $sortOrder = null,
        public array $technologies = [],
        public ?UploadedFile $coverImage = null,
        public array $galleryImages = [],
        public bool $replaceGallery = false,
    ) {}

    /**
     * Build a ProjectData instance from validated form request data and uploaded files.
     *
     * @param  array<string, mixed>  $validated
     * @param  array<int, UploadedFile>  $galleryImages
     */
    public static function fromArray(
        array $validated,
        ?UploadedFile $coverImage = null,
        array $galleryImages = [],
    ): self {
        $projectType = isset($validated['project_type'])
            ? ($validated['project_type'] instanceof ProjectTypeEnum
                ? $validated['project_type']
                : ProjectTypeEnum::from((string) $validated['project_type']))
            : ProjectTypeEnum::WebApp;

        $status = isset($validated['status'])
            ? ($validated['status'] instanceof ProjectStatusEnum
                ? $validated['status']
                : ProjectStatusEnum::from((string) $validated['status']))
            : ProjectStatusEnum::Published;

        $cover = $coverImage ?? (($validated['image'] ?? null) instanceof UploadedFile ? $validated['image'] : null);
        $gallery = ! empty($galleryImages)
            ? $galleryImages
            : (is_array($validated['gallery'] ?? null) ? array_values(array_filter($validated['gallery'], static fn (mixed $file): bool => $file instanceof UploadedFile)) : []);

        return new self(
            title: is_array($validated['title'] ?? null) ? $validated['title'] : [],
            categoryId: isset($validated['category_id']) && $validated['category_id'] !== '' ? (int) $validated['category_id'] : null,
            slug: isset($validated['slug']) && trim((string) $validated['slug']) !== '' ? trim((string) $validated['slug']) : null,
            subtitle: is_array($validated['subtitle'] ?? null) ? $validated['subtitle'] : [],
            shortDescription: is_array($validated['short_description'] ?? null) ? $validated['short_description'] : [],
            description: is_array($validated['description'] ?? null) ? $validated['description'] : [],
            challenge: is_array($validated['challenge'] ?? null) ? $validated['challenge'] : [],
            solution: is_array($validated['solution'] ?? null) ? $validated['solution'] : [],
            results: is_array($validated['results'] ?? null) ? $validated['results'] : [],
            clientName: is_array($validated['client_name'] ?? null) ? $validated['client_name'] : [],
            roleTitle: is_array($validated['role_title'] ?? null) ? $validated['role_title'] : [],
            projectType: $projectType,
            status: $status,
            liveUrl: isset($validated['live_url']) && $validated['live_url'] !== '' ? (string) $validated['live_url'] : null,
            repoUrl: isset($validated['repo_url']) && $validated['repo_url'] !== '' ? (string) $validated['repo_url'] : null,
            videoUrl: isset($validated['video_url']) && $validated['video_url'] !== '' ? (string) $validated['video_url'] : null,
            completedAt: isset($validated['completed_at']) && $validated['completed_at'] !== '' ? (string) $validated['completed_at'] : null,
            duration: is_array($validated['duration'] ?? null) ? $validated['duration'] : [],
            metrics: is_array($validated['metrics'] ?? null) ? $validated['metrics'] : [],
            metaTitle: is_array($validated['meta_title'] ?? null) ? $validated['meta_title'] : [],
            metaDescription: is_array($validated['meta_description'] ?? null) ? $validated['meta_description'] : [],
            isFeatured: (bool) ($validated['is_featured'] ?? false),
            isActive: array_key_exists('is_active', $validated) ? (bool) $validated['is_active'] : true,
            sortOrder: isset($validated['sort_order']) && $validated['sort_order'] !== '' ? (int) $validated['sort_order'] : null,
            technologies: is_array($validated['technologies'] ?? null) ? $validated['technologies'] : [],
            coverImage: $cover,
            galleryImages: $gallery,
            replaceGallery: (bool) ($validated['replace_gallery'] ?? false),
        );
    }

    /**
     * Resolve the preferred source string for generating a URL-safe slug.
     */
    public function preferredSlugSource(): string
    {
        if ($this->slug !== null && $this->slug !== '') {
            return $this->slug;
        }

        return (string) ($this->title['en'] ?? $this->title['ar'] ?? 'project');
    }

    /**
     * Convert the DTO into an Eloquent mass-assignable attributes array.
     *
     * @return array<string, mixed>
     */
    public function toAttributes(?string $resolvedSlug = null, ?int $defaultSortOrder = null): array
    {
        $attributes = [
            'category_id' => $this->categoryId,
            'title' => $this->title,
            'slug' => $resolvedSlug ?? $this->slug,
            'subtitle' => $this->subtitle,
            'short_description' => $this->shortDescription,
            'description' => $this->description,
            'challenge' => $this->challenge,
            'solution' => $this->solution,
            'results' => $this->results,
            'client_name' => $this->clientName,
            'role_title' => $this->roleTitle,
            'project_type' => $this->projectType->value,
            'status' => $this->status->value,
            'live_url' => $this->liveUrl,
            'repo_url' => $this->repoUrl,
            'video_url' => $this->videoUrl,
            'completed_at' => $this->completedAt,
            'duration' => $this->duration,
            'metrics' => $this->metrics,
            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,
            'is_featured' => $this->isFeatured,
            'is_active' => $this->isActive,
        ];

        $sortOrder = $this->sortOrder ?? $defaultSortOrder;
        if ($sortOrder !== null) {
            $attributes['sort_order'] = $sortOrder;
        }

        return $attributes;
    }
}
