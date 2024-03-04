<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaginatedCollection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function renderPaginatedCollectionResponse(
        Request                 $request,
        LengthAwarePaginator    $data,
        JsonResource|string     $resource,
        array                   $additional = []
    ): array|\JsonSerializable|Arrayable
    {
        return (new PaginatedCollection(
            $data->withQueryString(),
            $resource
        ))->additional($additional)->toArray($request);
    }
}
