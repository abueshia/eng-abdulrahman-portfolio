<?php

/**
 * BlogResource
 *
 * Transforms a Blog model into a localized public API resource.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Enums\BlogStatusEnum;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Blog
 */
class BlogResource extends JsonResource
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
        $statusEnum = $this->status instanceof BlogStatusEnum
            ? $this->status
            : BlogStatusEnum::tryFrom((string) $this->status);

        $coverUrl = $this->getFirstMediaUrl('blogs');
        $absoluteCover = $coverUrl !== ''
            ? (str_starts_with($coverUrl, 'http') ? $coverUrl : url($coverUrl))
            : null;

        $localizedName = (string) $this->getTranslation('name', $locale);

        return [
            'id' => $this->id,
            'name' => $localizedName,
            'title' => $localizedName,
            'slug' => $this->slug,
            'short_description' => $this->getTranslation('short_description', $locale),
            'description' => $this->getTranslation('description', $locale),
            'meta_title' => $this->getTranslation('meta_title', $locale),
            'meta_description' => $this->getTranslation('meta_description', $locale),
            'tags' => $this->tags,
            'status' => $statusEnum?->value ?? (string) $this->status,
            'published_at' => $this->published_at?->toIso8601String(),
            'reading_time_minutes' => (int) ($this->reading_time_minutes ?? 1),
            'views_count' => (int) ($this->views_count ?? 0),
            'is_featured' => (bool) $this->is_featured,
            'sort_order' => (int) $this->sort_order,
            'cover_image' => $absoluteCover,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
