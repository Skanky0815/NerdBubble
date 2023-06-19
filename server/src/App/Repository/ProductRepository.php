<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Article;
use App\Models\Product;
use Domains\Article\Repositories\Products;
use Domains\Article\ValueObjects\ProductName;

class ProductRepository implements Products
{
    public function findByNameOrCreate(array $productData, Article $article): Product
    {
        return Product::firstOrCreate(
            [
                'name' => $productData['name'],
            ],
            [
                ...$productData,
                'article_id' => $article->id,
            ]
        );
    }

    public function withTheGivenNameDoNotExist(ProductName $name): bool
    {
        return false === Product::where(['name' => (string) $name])->exists();
    }
}
