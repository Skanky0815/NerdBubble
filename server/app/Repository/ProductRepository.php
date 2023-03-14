<?php declare(strict_types=1);

namespace App\Repository;

use App\Models\Article;
use App\Models\Product;

class ProductRepository
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

    public function withNameNotExists(string $name): bool
    {
        return false === Product::where(['name' => $name])->exists();
    }
}
