<?php

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginationCollection extends ResourceCollection
{


    /**
     * @param Request $data
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable|mixed
     */
    public function toArray($data)
    {
        $paginate = json_encode([
            "current_page"    => $this->currentPage(),
            "first_page_url"  =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'=1',
            "prev_page_url"   =>  $this->previousPageUrl() ?? '',
            "next_page_url"   =>  $this->nextPageUrl()  ?? '',
            "last_page_url"   =>  $this->getOptions()['path'].'?'.$this->getOptions()['pageName'].'='.$this->lastPage(),
            "total_pages"     =>  $this->lastPage(),
            "per_page"        =>  $this->perPage(),
            "total_items"     =>  $this->total(),
            "path"            =>  $this->getOptions()['path'],
        ]);
        return json_decode($paginate);
    }

}
