<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PointssettingResource extends JsonResource
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
            'invite_friend' => $this->invite_friend,
            'product_code' => $this->product_code,
            'new_registration' => $this->new_registration,
        ];
     
        

       
        return $data;
    }


}
