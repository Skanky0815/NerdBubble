<?php declare(strict_types=1);

namespace Tests\Unit\Domain\Article\Services\Provider;

use Domains\Article\Aggregates\Article;
use Domains\Article\Entities\Keyword;
use Domains\Article\Entities\Product;
use Domains\Article\Exceptions\ProviderException;
use Domains\Article\Factories\ArticleFactory;
use Domains\Article\Factories\ProductFactory;
use Domains\Article\Repositories\Articles;
use Domains\Article\Repositories\Keywords;
use Domains\Article\Services\HttpClient;
use Domains\Article\Services\Provider\Asmodee;
use Domains\Article\ValueObjects\Provider;
use DOMDocument;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\Fixtures\Domains\Article\Entities\ArticleFixture;

class AsmodeeTest extends MockeryTestCase
{
    use ArticleFixture;

    private (Keywords&MockInterface)|(Keywords&LegacyMockInterface) $keywords;
    private (HttpClient&MockInterface)|(HttpClient&LegacyMockInterface) $httpClient;
    private (Articles&MockInterface)|(Articles&LegacyMockInterface) $articles;
    private (ArticleFactory&MockInterface)|(ArticleFactory&LegacyMockInterface) $articleFactory;
    private (ProductFactory&MockInterface)|(ProductFactory&LegacyMockInterface) $productFactory;

    #[Test]
    public function crawl_when_article_data_found_then_a_article_collection_will_be_returned(): void
    {
        $article = $this->createArticle();

        $dom = new DOMDocument();
        $dom->loadHTML('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>');

        $this->httpClient->allows()->loadContentFromWebsite('https://www.asmodee.de')->andReturn($dom);
        $this->httpClient->allows()
            ->loadContentFromWebsite('https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json')
            ->andReturn([
              "pageProps" => [
                "articles" => [
                  [
                    "headline" =>"test",
                    "subHeadline" => "sub test line",
                    "content" => [],
                    "slug" => "noooo",
                    "creationDate" => "1984-01-01",
                    "tileImage" => [
                      "formats" => [
                        "small" => [
                          "url" => "https://image-url.png",
                        ],
                      ],
                    ],
                  ],
                ],
              ],
            ]);

        $this->keywords->allows()->all()->andReturn([Keyword::fromString('test')]);

        $this->articles->expects()->addAll([$article])->once();

        $this->articleFactory->allows()->setArticleData(
            Provider::ASMODEE,
            'test',
            Mockery::any(),
            'https://image-url.png',
            'https://www.asmodee.de/product/noooo',
            'sub test line',
        )->andReturnSelf();
        $this->articleFactory->allows()->build()->andReturn($article);

        $this->service()->crawl();
    }

    #[Test]
    public function crawl_when_product_is_empty_then_a_article_without_products_will_be_created(): void
    {
        $dom = new DOMDocument();
        $dom->loadHTML('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>');

        $this->httpClient->allows()->loadContentFromWebsite('https://www.asmodee.de')->andReturn($dom);
        $this->httpClient->allows()
            ->loadContentFromWebsite('https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json')
            ->andReturn([
              "pageProps" => [
                "articles" => [
                  [
                    "headline" => "test",
                    "subHeadline" => "sub test line",
                    "content" => [
                      "product" => [],
                    ],
                    "slug" => "noooo",
                    "creationDate" => "1984-01-01",
                    "tileImage" => [
                      "formats" => [
                        "small" => [
                          "url" => "https://image-url.png",
                        ],
                      ],
                    ],
                  ],
                ],
                ],
            ]);

        $this->keywords->allows()->all()->andReturn([Keyword::fromString('test')]);
        $this->articles->expects()->addAll(Mockery::on(function (Article ...$articles) {
            static::assertCount(1, $articles);

            $article = $articles[0];
            static::assertInstanceOf(Article::class, $article);
            static::assertCount(0, $article->products);

            return true;
        }))->once();

        $this->service()->crawl();
    }

    #[Test]
    public function crawl_when_products_data_found_then_a_article_with_products_will_be_created(): void
    {
        $dom = new DOMDocument();
        $dom->loadHTML('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>');

        $this->httpClient->allows()->loadContentFromWebsite('https://www.asmodee.de')->andReturn($dom);
        $this->httpClient->allows()
            ->loadContentFromWebsite('https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json')
            ->andReturn([
                  "pageProps" => [
                    "articles" => [
                      [
                        "headline" =>"test",
                        "subHeadline" => "sub test line",
                        "content" => [
                          [
                            "product" => [
                              "name" => "Go-NinjaGO",
                              "slug" => "nin-slug-go",
                              "facets" => [
                                "image" => "https://image-bild.png",
                              ],
                            ],
                          ],
                        ],
                        "slug" => "noooo",
                        "creationDate" => "1984-01-01",
                        "tileImage" => [
                          "formats" => [
                            "small" => [
                              "url"=>  "https://image-url.png",
                            ],
                          ],
                        ],
                      ],
                    ],
                  ],
                ]);

        $this->keywords->allows()->all()->andReturn([Keyword::fromString('test')]);

        $this->articles->expects()->addAll(Mockery::on(function (Article ...$articles) {
            static::assertCount(1, $articles);
            $article = $articles[0];

            static::assertInstanceOf(Article::class, $article);
            static::assertCount(1, $article->products);
            static::assertSame('https://www.asmodee.de/news/noooo', (string)$article->link);

            $product = $article->products->offsetGet(0);
            static::assertInstanceOf(Product::class, $product);
            static::assertSame('Go-NinjaGO', (string)$product->name);
            static::assertSame('https://www.asmodee.de/produkte/nin-slug-go', (string)$product->link);
            static::assertSame('https://image-bild.png', (string)$product->image);

            return true;
        }))->once();

        $this->service()->crawl();
    }

    #[Test]
    public function crawl_when_no_hash_in_first_call_then_a_exception_will_be_thrown(): void
    {
        $this->expectException(ProviderException::class);

        $this->httpClient->allows()->loadContentFromWebsite('https://www.asmodee.de')->andReturn(new DOMDocument());

        $this->service()->crawl();
    }

    protected function mockeryTestSetUp(): void
    {
        $this->keywords = Mockery::mock(Keywords::class);
        $this->httpClient = Mockery::mock(HttpClient::class);
        $this->articles = Mockery::mock(Articles::class);
        $this->articleFactory = Mockery::mock(ArticleFactory::class);
        $this->productFactory = Mockery::mock(ProductFactory::class);
    }

    private function service(): Asmodee
    {
        return new Asmodee(
            $this->keywords,
            $this->articles,
            $this->httpClient,
            $this->articleFactory,
            $this->productFactory,
        );
    }
}
