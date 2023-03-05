<?php

namespace App\Services\Crawler\Asmodee\DTO;

readonly class Product
{
    public function __construct(
        public string $name,
        public string $slug,
        public string $image,
    ) {
    }

    public static function createFromArray(array $productData): self
    {
        return new Product(
            $productData['name'],
            $productData['slug'],
            $productData['facets']['image'],
        );
    }
}
