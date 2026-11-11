<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'address' => $this->address,
            'facebook' => $this->facebook,
            'iniesta' => $this->iniesta,
            'tiktok' => $this->tiktok,
            'x' => $this->x,
            'whatsapp' => $this->whatsapp,
            
            

            




        ];
    }
}
