<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Article\Factories;

use Carbon\CarbonImmutable;
use Domains\Article\Entities\Product;
use Domains\Article\Factories\ArticleFactory;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\ProductName;
use Domains\Article\ValueObjects\ProviderType;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ArticleFactoryTest extends TestCase
{
    #[Test]
    public function buildShouldCreateANewArticleModelInstance(): void
    {
        $article = $this->service()
            ->setArticleData(
                provider: ProviderType::ASMODEE,
                headline: 'headline',
                publishDate: CarbonImmutable::create(1984),
                image: 'https://article-image.png',
                link: 'https://article.link',
            )->build()
        ;

        static::assertSame(ProviderType::ASMODEE, $article->provider);
        static::assertSame('https://article-image.png', (string) $article->image);
        static::assertSame('https://article.link', (string) $article->link);
        static::assertSame('headline', (string) $article->headline);
        static::assertSame('1984-01-01', (string) $article->publishDate);
        static::assertNull($article->description);
        static::assertNull($article->subHeadline);
        static::assertTrue($article->products->isEmpty());
    }

    #[Test]
    public function buildWhenDescriptionIsGivenThenDescriptionIsNotNull(): void
    {
        $article = $this->service()
            ->setArticleData(
                provider: ProviderType::ASMODEE,
                headline: 'headline',
                publishDate: CarbonImmutable::create(1984),
                image: 'https://article-image.png',
                link: 'https://article.link',
                description: 'some text'
            )->build()
        ;

        static::assertSame('some text', (string) $article->description);
    }

    #[Test]
    public function buildWhenSubHeadlineIsGivenThenSubHeadlineIsNotNull(): void
    {
        $article = $this->service()
            ->setArticleData(
                provider: ProviderType::ASMODEE,
                headline: 'headline',
                publishDate: CarbonImmutable::create(1984),
                image: 'https://article-image.png',
                link: 'https://article.link',
                subHeadline: 'sub headline'
            )->build()
        ;

        static::assertSame('sub headline', (string) $article->subHeadline);
    }

    #[Test]
    public function buildWhenProductsAreGivenThenProductsIsNotEmpty(): void
    {
        $article = $this->service()
            ->setArticleData(
                provider: ProviderType::ASMODEE,
                headline: 'headline',
                publishDate: CarbonImmutable::create(1984),
                image: 'https://article-image.png',
                link: 'https://article.link',
            )->setProducts([
                new Product(
                    name: new ProductName('product'),
                    link: new Link('https://some.ling'),
                    image: new ImageUrl('https://image.url')
                ),
            ])->build()
        ;

        static::assertFalse($article->products->isEmpty());
    }

    private function service(): ArticleFactory
    {
        return new ArticleFactory();
    }
}
