<?php

/**
 * ProjectResource
 *
 * Transforms a Project model and its eager-loaded case-study relations
 * into a localized public API resource with absolute media URLs.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Enums\ProjectStatusEnum;
use App\Enums\ProjectTypeEnum;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @mixin Project
 */
class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $locale = app()->getLocale();

        $typeEnum = $this->project_type instanceof ProjectTypeEnum
            ? $this->project_type
            : ProjectTypeEnum::tryFrom((string) $this->project_type);

        $statusEnum = $this->status instanceof ProjectStatusEnum
            ? $this->status
            : ProjectStatusEnum::tryFrom((string) $this->status);

        $coverUrl = $this->getFirstMediaUrl('projects');
        $absoluteCover = $coverUrl !== ''
            ? (str_starts_with($coverUrl, 'http') ? $coverUrl : url($coverUrl))
            : null;

        $gallery = $this->getMedia('projects_gallery')
            ->map(static function (Media $media): string {
                $mediaUrl = $media->getUrl();

                return str_starts_with($mediaUrl, 'http') ? $mediaUrl : url($mediaUrl);
            })
            ->values()
            ->all();

        return [
            'id' => $this->id,
            'title' => (string) $this->getTranslation('title', $locale),
            'subtitle' => $this->getTranslation('subtitle', $locale),
            'slug' => $this->slug,
            'short_description' => $this->getTranslation('short_description', $locale),
            'description' => $this->getTranslation('description', $locale),
            'challenge' => $this->getTranslation('challenge', $locale),
            'solution' => $this->getTranslation('solution', $locale),
            'results' => $this->getTranslation('results', $locale),
            'metrics' => $this->metrics,
            'client_name' => $this->getTranslation('client_name', $locale),
            'role_title' => $this->getTranslation('role_title', $locale),
            'duration' => $this->getTranslation('duration', $locale),
            'project_type' => $typeEnum?->value ?? (string) $this->project_type,
            'project_type_label' => $typeEnum?->label(),
            'status' => $statusEnum?->value ?? (string) $this->status,
            'live_url' => $this->live_url,
            'repo_url' => $this->repo_url,
            'case_study_url' => $this->case_study_url,
            'started_at' => $this->started_at?->toDateString(),
            'completed_at' => $this->completed_at?->toDateString(),
            'is_featured' => (bool) $this->is_featured,
            'sort_order' => (int) $this->sort_order,
            'cover_image' => $absoluteCover,
            'gallery' => $gallery,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'technologies' => TechnologyResource::collection($this->whenLoaded('technologies')),
            'testimonials' => TestimonialResource::collection($this->whenLoaded('testimonials')),
        ];
    }
}
