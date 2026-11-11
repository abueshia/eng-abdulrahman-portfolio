<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProductResource extends JsonResource
{

    public function toArray($request): array
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'images' => $this->getMedia('products')->map(function ($media) {
                return $media->getUrl();
            }),
            'productcategory' => [
                'id' => $this->productCategory->id ?? null,
                'name' => $this->productCategory->name ?? null,
            ],
        ];

        $data['is_favorite'] = 0;
        if (auth('client_api')->check()) {
            $check = DB::table('favorite_products')->where('product_id', $this->id)
                ->where('client_id', auth('client_api')->id())->first();
            $data['is_favorite'] = $check ? 1 : 0;
        }

        return $data;
    }
    
    // public function toArray($request): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'description' => $this->description,
    //         'images' => $this->getMedia('products')->map(function ($media) {
    //             return $media->getUrl();
    //         }),
    //         'productcategory' => [
    //             'id' => $this->productCategory->id ?? null,
    //             'name' => $this->productCategory->name ?? null,
    //         ],
    //     ];
    // }


 

}
