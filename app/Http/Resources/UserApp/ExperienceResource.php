<?php

/**
 * ExperienceResource
 *
 * Transforms an Experience model into a localized public API resource.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Enums\EmploymentTypeEnum;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Experience
 */
class ExperienceResource extends JsonResource
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
        $employmentTypeEnum = $this->employment_type instanceof EmploymentTypeEnum
            ? $this->employment_type
            : EmploymentTypeEnum::tryFrom((string) $this->employment_type);

        $logoUrl = $this->getFirstMediaUrl('experiences');
        $absoluteLogo = $logoUrl !== ''
            ? (str_starts_with($logoUrl, 'http') ? $logoUrl : url($logoUrl))
            : null;

        $achievements = $this->getTranslation('achievements', $locale);

        return [
            'id' => $this->id,
            'company_name' => (string) $this->getTranslation('company_name', $locale),
            'role_title' => (string) $this->getTranslation('role_title', $locale),
            'location' => $this->getTranslation('location', $locale),
            'summary' => $this->getTranslation('summary', $locale),
            'achievements' => $achievements,
            'highlights' => $achievements,
            'employment_type' => $employmentTypeEnum?->value ?? (string) $this->employment_type,
            'employment_type_label' => $employmentTypeEnum?->label(),
            'company_url' => $this->company_url,
            'start_date' => $this->start_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'is_current' => (bool) $this->is_current,
            'sort_order' => (int) $this->sort_order,
            'company_logo' => $absoluteLogo,
            'technologies' => TechnologyResource::collection($this->whenLoaded('technologies')),
        ];
    }
}
