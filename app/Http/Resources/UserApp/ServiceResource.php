<?php

/**
 * ServiceResource
 *
 * Transforms a Service model into a localized public API resource.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Service
 */
class ServiceResource extends JsonResource
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
        $mediaUrl = $this->getFirstMediaUrl('services');
        $absoluteImage = $mediaUrl !== ''
            ? (str_starts_with($mediaUrl, 'http') ? $mediaUrl : url($mediaUrl))
            : null;

        $features = $this->getTranslation('features', $locale);

        return [
            'id' => $this->id,
            'title' => (string) $this->getTranslation('title', $locale),
            'subtitle' => $this->getTranslation('subtitle', $locale),
            'slug' => $this->slug,
            'short_description' => $this->getTranslation('short_description', $locale),
            'description' => $this->getTranslation('description', $locale),
            'features' => $features,
            'deliverables' => $features,
            'icon_class' => $this->icon_class,
            'price_starting_from' => $this->price_starting_from,
            'is_featured' => (bool) $this->is_featured,
            'sort_order' => (int) $this->sort_order,
            'image' => $absoluteImage,
        ];
    }
}
