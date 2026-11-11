<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'is_valid' => $this->is_valid,
            'number' => $this->number,
            'validate_to' => $this->validate_to,
            
            'code' => $this->code,
            'group_id' => $this->group_id, 
            'product_id' => $this->product_id, 
            'name_group' => $this->group->name_group ?? null,
            'new_group_name' => $this->group->new_group_name ?? null,
            'new_group_name' => $this->group->new_group_name ?? null, 
            'points' => $this->group->points ?? null, 
            'status' => $this->status,
        ];

        return $data;
    }
}
