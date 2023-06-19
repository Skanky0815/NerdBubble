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
    public function build_should_create_a_new_product_model_instance(): void
    {
        $product = $this->service()
            ->setProductData(
                name: 'pTitle',
                link: 'https://product.link',
                image: 'https://product-image.png',
            )->build()
        ;

        self::assertSame('pTitle', (string) $product->name);
        self::assertSame('https://product.link', (string) $product->link);
        self::assertSame('https://product-image.png', (string) $product->image);
    }

    private function service(): ProductFactory
    {
        return new ProductFactory();
    }
}
