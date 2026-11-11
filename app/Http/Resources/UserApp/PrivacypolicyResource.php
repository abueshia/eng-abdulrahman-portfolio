<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivacypolicyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            // 'title' => $this->title,
            'description' => $this->description,
            
        ];
    }
}
