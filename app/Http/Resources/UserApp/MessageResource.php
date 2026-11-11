<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'phone' => $this->phone,
            'message' => $this->message,
            'email' => $this->email,
        
        ];
     
       
        return $data;
    }


}
