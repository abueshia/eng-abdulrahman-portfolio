<?php

/**
 * FaqResource
 *
 * Transforms an Faq model into a localized public API resource.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Faq
 */
class FaqResource extends JsonResource
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
            'question' => (string) $this->getTranslation('question', $locale),
            'answer' => (string) $this->getTranslation('answer', $locale),
            'category' => $this->category,
            'sort_order' => (int) $this->sort_order,
        ];
    }
}
