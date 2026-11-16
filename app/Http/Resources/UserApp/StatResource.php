<?php

/**
 * StatResource
 *
 * Transforms a Stat model into a localized public API resource.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Stat
 */
class StatResource extends JsonResource
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

        return [
            'id' => $this->id,
            'label' => (string) $this->getTranslation('label', $locale),
            'value' => $this->value,
            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
            'icon' => $this->icon,
            'icon_class' => $this->icon ?? $this->icon_class,
            'sort_order' => (int) $this->sort_order,
        ];
    }
}
