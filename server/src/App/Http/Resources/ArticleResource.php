<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Domains\Article\Aggregates\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Article
 */
class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'title' => (string) $this->headline,
            'subTitle' => (string) $this->subHeadline,
            'link' => (string) $this->link,
            'image' => (string) $this->image,
            'date' => (string) $this->publishDate,
            'provider' => $this->provider,
            'description' => (string) $this->description,
            'products' => ProductResource::collection($this->products->getArrayCopy()),
        ];
    }
}
