<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Article\Services\Provider;

use Domains\Article\Aggregates\Article;
use Domains\Article\Exceptions\ProviderException;
use Domains\Article\Factories\ArticleFactory;
use Domains\Article\Factories\ProductFactory;
use Domains\Article\Repositories\Articles;
use Domains\Article\Services\Crawler\Filter\KeywordFilter;
use Domains\Article\Services\Crawler\Filter\ProductExistFilter;
use Domains\Article\Services\HttpClient;
use Domains\Article\Services\Provider\Asmodee;
use Domains\Article\ValueObjects\ProviderType;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\Fixtures\Domains\Article\Entities\ArticleFixture;
use Tests\Fixtures\Domains\Article\Entities\ProductFixture;

/**
 * @internal
 *
 * @coversNothing
 */
class AsmodeeTest extends MockeryTestCase
{
    use ArticleFixture;
    use ProductFixture;

    private (KeywordFilter&LegacyMockInterface)|(KeywordFilter&MockInterface) $keywordFilter;
    private (HttpClient&LegacyMockInterface)|(HttpClient&MockInterface) $httpClient;
    private (Articles&LegacyMockInterface)|(Articles&MockInterface) $articles;
    private (ArticleFactory&LegacyMockInterface)|(ArticleFactory&MockInterface) $articleFactory;
    private (LegacyMockInterface&ProductFactory)|(MockInterface&ProductFactory) $productFactory;
    private (LegacyMockInterface&ProductExistFilter)|(MockInterface&ProductExistFilter) $productExistFilter;

    #[Test]
    public function crawlWhenArticleDataFoundThenAArticleCollectionWillBeReturned(): void
    {
        $article = $this->createArticle();

        $dom = new \DOMDocument();
        $dom->loadHTML('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>');

        $this->httpClient->allows()->loadContentFromWebsite('https://www.asmodee.de')->andReturn($dom);
        $this->httpClient->allows()
            ->loadContentFromWebsite('https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json')
            ->andReturn([
                'pageProps' => [
                    'articles' => [
                        [
                            'headline' => 'test',
                            'subHeadline' => 'sub test line',
                            'content' => [],
                            'slug' => 'noooo',
                            'creationDate' => '1984-01-01',
                            'tileImage' => [
                                'formats' => [
                                    'small' => [
                                        'url' => 'https://image-url.png',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ])
        ;

        $this->keywordFilter->allows()->removeArticlesWhoNotMatchAnyKeyword([$article])->andReturn([$article]);
        $this->productExistFilter->allows()->removeKnownProducts([])->andReturn([]);

        $this->articles->expects()->addAll($article)->once();

        $this->articleFactory->allows()->setArticleData(
            ProviderType::ASMODEE,
            'test',
            \Mockery::any(),
            'https://image-url.png',
            'https://www.asmodee.de/product/noooo',
            'sub test line',
        )->andReturnSelf();
        $this->articleFactory->allows()->setProducts([])->andReturnSelf();
        $this->articleFactory->allows()->build()->andReturn($article);

        $this->service()->crawl();
    }

    #[Test]
    public function crawlWhenProductIsEmptyThenAArticleWithoutProductsWillBeCreated(): void
    {
        $article = $this->createArticle();

        $dom = new \DOMDocument();
        $dom->loadHTML('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>');

        $this->httpClient->allows()->loadContentFromWebsite('https://www.asmodee.de')->andReturn($dom);
        $this->httpClient->allows()
            ->loadContentFromWebsite('https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json')
            ->andReturn([
                'pageProps' => [
                    'articles' => [
                        [
                            'headline' => 'test',
                            'subHeadline' => 'sub test line',
                            'content' => [
                                'product' => [],
                            ],
                            'slug' => 'noooo',
                            'creationDate' => '1984-01-01',
                            'tileImage' => [
                                'formats' => [
                                    'small' => [
                                        'url' => 'https://image-url.png',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ])
        ;

        $this->keywordFilter->allows()->removeArticlesWhoNotMatchAnyKeyword([$article])->andReturn([$article]);
        $this->productExistFilter->allows()->removeKnownProducts([])->andReturn([]);

        $this->articles->expects()->addAll(\Mockery::on(function (Article ...$articles) {
            static::assertCount(1, $articles);

            $article = $articles[0];
            static::assertInstanceOf(Article::class, $article);
            static::assertCount(0, $article->products);

            return true;
        }))->once();

        $this->articleFactory->allows()->setArticleData(
            ProviderType::ASMODEE,
            'test',
            \Mockery::any(),
            'https://image-url.png',
            'https://www.asmodee.de/product/noooo',
            'sub test line',
        )->andReturnSelf();
        $this->articleFactory->allows()->setProducts([])->andReturnSelf();
        $this->articleFactory->allows()->build()->andReturn($article);

        $this->service()->crawl();
    }

    #[Test]
    public function crawlWhenProductsDataFoundThenAArticleWithProductsWillBeCreated(): void
    {
        $article = $this->createArticle();
        $product = $this->createProduct();

        $dom = new \DOMDocument();
        $dom->loadHTML('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>');

        $this->httpClient->allows()->loadContentFromWebsite('https://www.asmodee.de')->andReturn($dom);
        $this->httpClient->allows()
            ->loadContentFromWebsite('https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json')
            ->andReturn([
                'pageProps' => [
                    'articles' => [
                        [
                            'headline' => 'test',
                            'subHeadline' => 'sub test line',
                            'content' => [
                                [
                                    'product' => [
                                        'name' => 'Go-NinjaGO',
                                        'slug' => 'nin-slug-go',
                                        'facets' => [
                                            'image' => 'https://image-bild.png',
                                        ],
                                    ],
                                ],
                            ],
                            'slug' => 'noooo',
                            'creationDate' => '1984-01-01',
                            'tileImage' => [
                                'formats' => [
                                    'small' => [
                                        'url' => 'https://image-url.png',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ])
        ;

        $this->keywordFilter->allows()->removeArticlesWhoNotMatchAnyKeyword([$article])->andReturn([$article]);
        $this->productExistFilter->allows()->removeKnownProducts([$product])->andReturn([$product]);

        $this->articles->expects()->addAll($article)->once();

        $this->productFactory->allows()->setProductData(
            'Go-NinjaGO',
            'https://www.asmodee.de/produkte/nin-slug-go',
            'https://image-bild.png',
        )->andReturnSelf();
        $this->productFactory->allows()->build()->andReturn($product);

        $this->articleFactory->allows()->setArticleData(
            ProviderType::ASMODEE,
            'test',
            \Mockery::any(),
            'https://image-url.png',
            'https://www.asmodee.de/news/noooo',
            'sub test line',
        )->andReturnSelf();
        $this->articleFactory->allows()->setProducts([$product])->andReturnSelf();
        $this->articleFactory->allows()->build()->andReturn($article);

        $this->service()->crawl();
    }

    #[Test]
    public function crawlWhenNoHashInFirstCallThenAExceptionWillBeThrown(): void
    {
        $this->expectException(ProviderException::class);

        $this->httpClient->allows()->loadContentFromWebsite('https://www.asmodee.de')->andReturn(new \DOMDocument());

        $this->service()->crawl();
    }

    protected function mockeryTestSetUp(): void
    {
        $this->keywordFilter = \Mockery::mock(KeywordFilter::class);
        $this->httpClient = \Mockery::mock(HttpClient::class);
        $this->articles = \Mockery::mock(Articles::class);
        $this->articleFactory = \Mockery::mock(ArticleFactory::class);
        $this->productFactory = \Mockery::mock(ProductFactory::class);
        $this->productExistFilter = \Mockery::mock(ProductExistFilter::class);
    }

    private function service(): Asmodee
    {
        return new Asmodee(
            $this->keywordFilter,
            $this->productExistFilter,
            $this->articles,
            $this->httpClient,
            $this->articleFactory,
            $this->productFactory,
        );
    }
}
