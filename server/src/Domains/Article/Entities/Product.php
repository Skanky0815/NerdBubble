<?php

declare(strict_types=1);

namespace Domains\Article\Entities;

use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\ProductName;

readonly class Product
{
    public function __construct(
        public ProductName $name,
        public Link $link,
        public ImageUrl $image,
        public ?Id $id = null,
    ) {}
}
