<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class BranchesResource extends JsonResource
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
            'image' => $this->getFirstMediaUrl('branches'),
            'address' => $this->address,
            'phone' => $this->phone,
            'google_map' => $this->google_map,
            // 'is_favorite' => $this->is_favorite,
            'offers' => OfferResource::collection($this->offers),
        ];
        $data['is_favorite'] = 0;
        if(auth('client_api')->check()) {
            $check = DB::table('favorite_branches')->where('branch_id', $this->id)
            ->where('client_id', auth('client_api')->id())->first();
            $data['is_favorite'] = $check ? 1 : 0;   
        }

        return $data;

    }
}
