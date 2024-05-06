<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Domains\Article\Entities\Keyword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Keyword
 */
class KeywordResource extends JsonResource
{
    public function __construct($resource, private readonly int $status)
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
        return [
            'id' => (string) $this->id,
            'word' => (string) $this->word,
        ];
    }

    public function toResponse($request): JsonResponse
    {
        return parent::toResponse($request)->setStatusCode($this->status);
    }
}
