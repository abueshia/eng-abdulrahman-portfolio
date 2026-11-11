<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteproductsResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'point' => $this->point,
            'discount' => $this->discount,
            'discount_number' => $this->discount_number,
            'image' => $this->getFirstMediaUrl('offers'),
            
            'products' => ProductResource::collection($this->products),
        ];
    }


}

