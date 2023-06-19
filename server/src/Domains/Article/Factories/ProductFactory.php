<?php

declare(strict_types=1);

namespace Domains\Article\Factories;

use Domains\Article\Entities\Product;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\ProductName;

class ProductFactory
{
    private ProductName $name;
    private Link $link;
    private ImageUrl $image;

    public function setProductData(
        string $name,
        string $link,
        string $image,
    ): self {
        $this->name = new ProductName($name);
        $this->link = new Link($link);
        $this->image = new ImageUrl($image);

        return $this;
    }

    public function build(): Product
    {
        return new Product(
            name: $this->name,
            link: $this->link,
            image: $this->image,
        );
    }
}
