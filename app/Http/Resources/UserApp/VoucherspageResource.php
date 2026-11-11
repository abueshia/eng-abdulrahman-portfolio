<?php

namespace App\Http\Resources\UserApp;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoucherspageResource extends JsonResource
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
            'product_id' => $this->product->name ?? '-',
            'coupon_id' => $this->coupon->code ?? '-',
            'points' => $this->points ?? '-',
            'status' => $this->status ?? '-',
            'created_at' => $this->created_at ? $this->created_at->format('d-m-Y h:i A') : '-',

            // 'client_id' => new ClientResource($this->client),
            'coupon_id' => new CouponResource($this->coupon),

            
        ];
    }

}
