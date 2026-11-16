<?php

/**
 * PaginationCollection
 *
 * Formats Eloquent LengthAwarePaginator metadata into the project's canonical
 * `pagination` JSON envelope used by `ApiResponseTrait::success_response_with_pagination`.
 */

declare(strict_types=1);

namespace App\Http\Resources\UserApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginationCollection extends ResourceCollection
{
    /**
     * Transform the pagination metadata into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $options = $this->resource->getOptions();
        $path = (string) ($options['path'] ?? $request->url());
        $pageName = (string) ($options['pageName'] ?? 'page');

        return [
            'current_page' => $this->resource->currentPage(),
            'first_page_url' => $path.'?'.$pageName.'=1',
            'prev_page_url' => $this->resource->previousPageUrl() ?? '',
            'next_page_url' => $this->resource->nextPageUrl() ?? '',
            'last_page_url' => $path.'?'.$pageName.'='.$this->resource->lastPage(),
            'total_pages' => $this->resource->lastPage(),
            'per_page' => $this->resource->perPage(),
            'total_items' => $this->resource->total(),
            'path' => $path,
        ];
    }
}

