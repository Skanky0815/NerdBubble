<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductListController extends Controller
{
    public function __invoke(Request $request): ResourceCollection
    {
        return ProductResource::collection($request->user()->products);
    }
}
