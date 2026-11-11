<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class VouchercodeofferResource extends JsonResource
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

            'client_id' => $this->client->name ?? '-',
            'offer_id' => $this->offer->name ?? '-',

            'discount_number' => $this->discount_number,
            'points' => $this->points ?? '-',
    
            
            // 'products' => ProductResource::collection($this->products),
        ];
    }



}

