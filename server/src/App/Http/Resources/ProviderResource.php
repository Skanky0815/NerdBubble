<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Domains\Article\Aggregates\Provider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * @mixin Provider
 */
class ProviderResource extends JsonResource
{
    public function __construct($resource, private readonly int $status = Response::HTTP_OK)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [...parent::toArray($request), 'id' => (string) $this->id];
    }

    public function toResponse($request): JsonResponse
    {
        return parent::toResponse($request)->setStatusCode($this->status);
    }
}
