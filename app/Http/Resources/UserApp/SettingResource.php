<?php

/**
 * SettingResource
 *
 * Transforms the public portfolio settings map into a localized, read-only JSON payload.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        if (is_array($this->resource)) {
            return $this->resource;
        }

        return (array) $this->resource;
    }
}

