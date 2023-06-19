<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Article\Factories;

use Carbon\CarbonImmutable;
use Domains\Article\Entities\Product;
use Domains\Article\Factories\ArticleFactory;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\ProductName;
use Domains\Article\ValueObjects\Provider;
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
    public function build_should_create_a_new_article_model_instance(): void
    {
        $article = $this->service()
            ->setArticleData(
                provider: Provider::ASMODEE,
                headline: 'headline',
                publishDate: CarbonImmutable::create(1984),
                image: 'https://article-image.png',
                link: 'https://article.link',
            )->build()
        ;

        self::assertSame(Provider::ASMODEE, $article->provider);
        self::assertSame('https://article-image.png', (string) $article->image);
        self::assertSame('https://article.link', (string) $article->link);
        self::assertSame('headline', (string) $article->headline);
        self::assertSame('1984-01-01', (string) $article->publishDate);
        self::assertNull($article->description);
        self::assertNull($article->subHeadline);
        self::assertTrue($article->products->isEmpty());
    }

    #[Test]
    public function build_when_description_is_given_then_description_is_not_null(): void
    {
        $article = $this->service()
            ->setArticleData(
                provider: Provider::ASMODEE,
                headline: 'headline',
                publishDate: CarbonImmutable::create(1984),
                image: 'https://article-image.png',
                link: 'https://article.link',
                description: 'some text'
            )->build()
        ;

        self::assertSame('some text', (string) $article->description);
    }

    #[Test]
    public function build_when_subHeadline_is_given_then_subHeadline_is_not_null(): void
    {
        $article = $this->service()
            ->setArticleData(
                provider: Provider::ASMODEE,
                headline: 'headline',
                publishDate: CarbonImmutable::create(1984),
                image: 'https://article-image.png',
                link: 'https://article.link',
                subHeadline: 'sub headline'
            )->build()
        ;

        self::assertSame('sub headline', (string) $article->subHeadline);
    }

    #[Test]
    public function build_when_products_are_given_then_products_is_not_empty(): void
    {
        $article = $this->service()
            ->setArticleData(
                provider: Provider::ASMODEE,
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

        self::assertFalse($article->products->isEmpty());
    }

    private function service(): ArticleFactory
    {
        return new ArticleFactory();
    }
}
