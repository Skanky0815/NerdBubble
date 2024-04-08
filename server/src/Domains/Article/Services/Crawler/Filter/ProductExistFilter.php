<?php

declare(strict_types=1);

namespace Domains\Article\Services\Crawler\Filter;

use Domains\Article\Entities\Product;
use Domains\Article\Repositories\Products;

class ProductExistFilter
{
    public function __construct(
        private readonly Products $products
    ) {}

    public function removeKnownProducts(array $allProducts): array
    {
        return array_filter(
            $allProducts,
            fn (Product $product): bool => $this->products->withTheGivenNameDoNotExist($product->name)
        );
    }
}
