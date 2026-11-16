<?php

/**
 * TechnologyResource
 *
 * Transforms a Technology model into a localized public API resource.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Enums\TechnologyCategoryEnum;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Technology
 */
class TechnologyResource extends JsonResource
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
        $categoryEnum = $this->category instanceof TechnologyCategoryEnum
            ? $this->category
            : TechnologyCategoryEnum::tryFrom((string) $this->category);

        $mediaUrl = $this->getFirstMediaUrl('technologies');
        $absoluteImage = $mediaUrl !== ''
            ? (str_starts_with($mediaUrl, 'http') ? $mediaUrl : url($mediaUrl))
            : null;

        return [
            'id' => $this->id,
            'name' => (string) $this->getTranslation('name', $locale),
            'slug' => $this->slug,
            'category' => $categoryEnum?->value ?? (string) $this->category,
            'category_label' => $categoryEnum?->label(),
            'icon_class' => $this->icon_class,
            'brand_color' => $this->brand_color,
            'proficiency_percent' => (int) $this->proficiency_percent,
            'years_experience' => $this->years_experience !== null ? (float) $this->years_experience : null,
            'is_featured' => (bool) $this->is_featured,
            'sort_order' => (int) $this->sort_order,
            'image' => $absoluteImage,
        ];
    }
}
