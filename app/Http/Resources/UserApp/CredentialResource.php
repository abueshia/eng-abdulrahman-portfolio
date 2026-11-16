<?php

/**
 * CredentialResource
 *
 * Transforms a Credential model into a localized public API resource.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use App\Enums\CredentialTypeEnum;
use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Credential
 */
class CredentialResource extends JsonResource
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
        $rawType = $this->type ?? $this->credential_type;
        $credentialTypeEnum = $rawType instanceof CredentialTypeEnum
            ? $rawType
            : CredentialTypeEnum::tryFrom((string) $rawType);

        $mediaUrl = $this->getFirstMediaUrl('credentials');
        $absoluteImage = $mediaUrl !== ''
            ? (str_starts_with($mediaUrl, 'http') ? $mediaUrl : url($mediaUrl))
            : null;

        return [
            'id' => $this->id,
            'title' => (string) $this->getTranslation('title', $locale),
            'organization' => (string) $this->getTranslation('organization', $locale),
            'description' => $this->getTranslation('description', $locale),
            'type' => $credentialTypeEnum?->value ?? (string) $rawType,
            'credential_type' => $credentialTypeEnum?->value ?? (string) $rawType,
            'credential_type_label' => $credentialTypeEnum?->label(),
            'issued_at' => $this->issued_at?->toDateString(),
            'expires_at' => $this->expires_at?->toDateString(),
            'credential_id' => $this->credential_id,
            'credential_url' => $this->credential_url,
            'sort_order' => (int) $this->sort_order,
            'image' => $absoluteImage,
        ];
    }
}
