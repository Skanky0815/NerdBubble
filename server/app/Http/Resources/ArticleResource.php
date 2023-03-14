<?php declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Article;
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
            'id' => $this->id,
            'title' => $this->title,
            'subTitle' => $this->subTitle,
            'link' => $this->link,
            'image' => $this->image,
            'date' => $this->date->format('Y-m-d'),
            'provider' => $this->provider,
            'description' => $this->description,
            'products' => ProductResource::collection($this->products),
        ];
    }
}