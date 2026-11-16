<?php

/**
 * CategoryResource
 *
 * Transforms a Category model into a localized public API resource.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Category
 */
class CategoryResource extends JsonResource
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
        $mediaUrl = $this->getFirstMediaUrl('categories');
        $absoluteImage = $mediaUrl !== ''
            ? (str_starts_with($mediaUrl, 'http') ? $mediaUrl : url($mediaUrl))
            : null;

        return [
            'id' => $this->id,
            'name' => (string) $this->getTranslation('name', $locale),
            'slug' => $this->slug,
            'description' => $this->getTranslation('description', $locale),
            'icon_class' => $this->icon_class,
            'sort_order' => (int) $this->sort_order,
            'image' => $absoluteImage,
            'projects_count' => $this->whenCounted('projects'),
            'blogs_count' => $this->whenCounted('blogs'),
        ];
    }
}
