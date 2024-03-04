<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginatedCollection
{
    private $resourceClass;
    private $additional;
    private $resource;

    public function __construct($resource, $resourceClass)
    {
        /** @var LengthAwarePaginator resource */
        $this->resource = $resource;
        $this->resourceClass = $resourceClass;
    }

    public function toArray($request): array
    {
        $data = [
            'data' => $this->resourceClass::collection(
                $this->resource->items()
            )->resolve($request),
            'links' => [
                'current_page' => $this->resource->currentPage(),
                'first_page_url' => $this->resource->url(1),
                'from' => $this->resource->firstItem(),
                'last_page' => $this->resource->lastPage(),
                'last_page_url' => $this->resource->url($this->resource->lastPage()),
                'links' => $this->resource->linkCollection()->toArray(),
                'next_page_url' => $this->resource->nextPageUrl(),
                'path' => $this->resource->path(),
                'per_page' => $this->resource->perPage(),
                'prev_page_url' => $this->resource->previousPageUrl(),
                'to' => $this->resource->lastItem(),
                'total' => $this->resource->total(),
            ],
        ];

        return array_merge(
            $data,
            $this->additional,
        );
    }

    public function additional($additional): self
    {
        $this->additional = $additional;
        return $this;
    }
}
