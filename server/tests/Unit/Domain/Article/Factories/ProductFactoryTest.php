<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Article\Factories;

use Domains\Article\Factories\ProductFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ProductFactoryTest extends TestCase
{
    #[Test]
    public function buildShouldCreateANewProductModelInstance(): void
    {
        $product = $this->service()
            ->setProductData(
                name: 'pTitle',
                link: 'https://product.link',
                image: 'https://product-image.png',
            )->build()
        ;

        static::assertSame('pTitle', (string) $product->name);
        static::assertSame('https://product.link', (string) $product->link);
        static::assertSame('https://product-image.png', (string) $product->image);
    }

    private function service(): ProductFactory
    {
        return new ProductFactory();
    }
}
