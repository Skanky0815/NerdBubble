<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Entities\Product;

class Products extends \ArrayIterator
{
    public function __construct(
        private readonly array $products
    ) {
        parent::__construct($this->products);

        $this->validate();
    }

    public function filterText(): FilterText
    {
        $filterTexts = array_map(fn (Product $product): \Stringable => $product->name, $this->products);

        return new FilterText(...$filterTexts);
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    private function validate(): void
    {
        foreach ($this->products as $product) {
            if (!$product instanceof Product) {
                throw new \InvalidArgumentException('Invalid Product!');
            }
        }
    }
}
