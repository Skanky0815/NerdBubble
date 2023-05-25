<?php declare(strict_types=1);

namespace App\Http\Resources;

use Domains\Article\Entities\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            'name' => (string)$this->name,
            'link' => (string)$this->link,
            'image' => (string)$this->image,
        ];
    }
}
