<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductMarkController extends Controller
{
    public function __invoke(string $productId, Request $request): Response
    {
        $request->user()->addProduct($productId);

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
