<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'is_valid' => $this->is_valid,
            'is_banned' => $this->is_banned,
            'points' => $this->points,
            'validate_to' => $this->validate_to,
        ];
     
        
        return $data;
    }


}
