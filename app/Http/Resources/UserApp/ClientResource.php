<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'code_for_client' => $this->code_for_client,
            'phone' => $this->phone,
            'card' => $this->card,
            'username' => $this->username,
            'is_banned' => $this->is_banned,
            'category' => $this->category,
            'points' => $this->points,
            'is_active' => $this->is_active,
            // 'image' => $this->image,
            'image' => $this->getFirstMediaUrl('clients_image'),
            'imageprofile' => $this->getFirstMediaUrl('client_profile'),
            
            // 'image' => $this->getFirstMediaUrl('paints_category'), 
            // 'city_id' => new CityResource($this->city_id),
            // 'region_id' => new CityResource($this->region_id),
            'city_id' => new CityResource($this->city),

            'region_id' => new CityResource($this->region),

            'country_id' => new CountryResource($this->country),
            
            'paint_categories' => PaintsCategoryResource::collection($this->paintscategories),
        ];
        if($request->is('api/auth/register') || $request->is('api/auth/login')) {
            $data['token'] = $this->createToken('gcl')->accessToken;
        }
       
        return $data;
    }


}
