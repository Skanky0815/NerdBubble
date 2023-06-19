<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProductMarkController extends Controller
{
    public function __invoke(string $productId, Request $request): Response
    {
        $request->user()->products()->attach($productId, ['id'=> Str::uuid()]);

        return response([], Response::HTTP_NO_CONTENT);
    }
}
