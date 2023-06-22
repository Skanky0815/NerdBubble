<?php

declare(strict_types=1);

namespace Tests\Fixtures\Domains\Article\Entities;

use Domains\Article\Entities\Product;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\ProductName;

trait ProductFixture
{
    private function createProduct(): Product
    {
        $faker = fake();

        return new Product(
            name: new ProductName($faker->paragraph),
            link: new Link($faker->url),
            image: new ImageUrl($faker->imageUrl),
        );
    }
}
