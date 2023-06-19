<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Services\Crawler\AssmodeeProvider;
use App\Services\Crawler\DTO\AsmodeeArticle;
use App\Services\Crawler\DTO\AsmodeeProduct;
use App\Services\Crawler\KeywordFilter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class AssmodeeProviderTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private (KeywordFilter&MockInterface)|(KeywordFilter&LegacyMockInterface) $keywordFilter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->keywordFilter = \Mockery::mock(KeywordFilter::class);
    }

    public function testGetArticlesWhenArticleDataFoundThenAArticleCollectionWillBeReturned(): void
    {
        Http::fake([
            'https://www.asmodee.de' => Http::response('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>'),
            'https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json' => Http::response(<<<'JSON'
                    {
                      "pageProps": {
                        "articles": [
                          {
                            "headline":"test",
                            "subHeadline":"sub test line",
                            "content":[],
                            "slug":"noooo",
                            "creationDate":"1984-01-01",
                            "tileImage": {
                              "formats": {
                                "small": {
                                  "url": "image-url.png"
                                }
                              }
                            }
                          }
                        ]
                      }
                    }
                JSON),
        ]);

        $this->keywordFilter->allows()->matchKeyword('testsub test line')->andReturn(true);

        $result = $this->service()->loadArticles();

        self::assertCount(1, $result);
        $article = $result->get(0);

        self::assertInstanceOf(AsmodeeArticle::class, $article);
        $articleData = $article->toArray();

        self::assertSame('test', $articleData['title']);
        self::assertSame('sub test line', $articleData['subTitle']);
        self::assertSame('https://www.asmodee.de/news/noooo', $articleData['link']);
        self::assertSame('image-url.png', $articleData['image']);
        self::assertInstanceOf(Carbon::class, $articleData['date']);
    }

    public function testGetArticlesWhenProductIsEmptyThenAArticleWithoutProductsWillBeCreated(): void
    {
        Http::fake([
            'https://www.asmodee.de' => Http::response('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>'),
            'https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json' => Http::response(
                <<<'JSON'
                        {
                          "pageProps": {
                            "articles": [
                              {
                                "headline":"test",
                                "subHeadline":"sub test line",
                                "content": {
                                  "product": []
                                },
                                "slug":"noooo",
                                "creationDate":"1984-01-01",
                                "tileImage": {
                                  "formats": {
                                    "small": {
                                      "url": "image-url.png"
                                    }
                                  }
                                }
                              }
                            ]
                          }
                        }
                    JSON
            ),
        ]);

        $this->keywordFilter->allows()->matchKeyword('testsub test line')->andReturn(true);

        $result = $this->service()->loadArticles();

        self::assertCount(1, $result);
        $article = $result->get(0);

        self::assertInstanceOf(AsmodeeArticle::class, $article);

        self::assertCount(0, $article->products());
    }

    public function testGetArticlesWhenProductsDataFoundThenAArticleWithProductsWillBeCreated(): void
    {
        Http::fake([
            'https://www.asmodee.de' => Http::response('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>'),
            'https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json' => Http::response(
                <<<'JSON'
                        {
                          "pageProps": {
                            "articles": [
                              {
                                "headline":"test",
                                "subHeadline":"sub test line",
                                "content": [
                                  {
                                    "product": {
                                      "name": "Go-NinjaGO",
                                      "slug": "nin-slug-go",
                                      "facets": {
                                        "image": "image-bild.png"
                                      }
                                    }
                                  }
                                ],
                                "slug":"noooo",
                                "creationDate":"1984-01-01",
                                "tileImage": {
                                  "formats": {
                                    "small": {
                                      "url": "image-url.png"
                                    }
                                  }
                                }
                              }
                            ]
                          }
                        }
                    JSON
            ),
        ]);

        $this->keywordFilter->allows()->matchKeyword('Go-NinjaGO')->andReturn(true);
        $this->keywordFilter->allows()->matchKeyword('testsub test lineGo-NinjaGO')->andReturn(true);

        $result = $this->service()->loadArticles();

        self::assertCount(1, $result);
        $article = $result->get(0);

        self::assertInstanceOf(AsmodeeArticle::class, $article);

        self::assertCount(1, $article->products());

        $product = $article->products()->get(0);

        self::assertInstanceOf(AsmodeeProduct::class, $product);
        $productData = $product->toArray();

        self::assertSame('Go-NinjaGO', $productData['name']);
        self::assertSame('https://www.asmodee.de/produkte/nin-slug-go', $productData['link']);
        self::assertSame('image-bild.png', $productData['image']);
    }

    private function service(): AssmodeeProvider
    {
        return new AssmodeeProvider(
            $this->keywordFilter,
        );
    }
}
