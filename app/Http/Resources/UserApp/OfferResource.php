<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray($request): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'description' => $this->description,
    //         'point' => $this->point,
    //         'discount' => $this->discount,
    //         'discount_number' => $this->discount_number,
    //         'image' => $this->getFirstMediaUrl('offers'),
            
    //         'products' => ProductResource::collection($this->products),
    //     ];
    // }

    public function toArray($request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'point' => $this->point,
            'discount' => $this->discount,
            'discount_number' => $this->discount_number,
            'image' => $this->getFirstMediaUrl('offers'),
            'products' => ProductResource::collection($this->products),
        ];
        $data['is_favorite'] = 0;
        if (auth('client_api')->check()) {
            $check = DB::table('favoriteoffers')->where('offer_id', $this->id)
                ->where('client_id', auth('client_api')->id())->first();
            $data['is_favorite'] = $check ? 1 : 0;
        }

        return $data;
    }


}

