<?php declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Article;
use App\Models\Product;
use App\Repository\ArticleRepository;
use App\Repository\ProductRepository;
use App\Services\Crawler\CrawlerService;
use App\Services\Crawler\DTO\Article as ArticleDTO;
use App\Services\Crawler\DTO\Product as ProductDTO;
use App\Services\Crawler\Provider;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;

class CrawlerServiceTest extends MockeryTestCase
{
    private (Provider&MockInterface)|(Provider&LegacyMockInterface) $provider;
    private (ArticleRepository&MockInterface)|(ArticleRepository&LegacyMockInterface) $articleRepository;
    private (ProductRepository&MockInterface)|(ProductRepository&LegacyMockInterface) $productRepository;

    public function testCrawl_when_articles_and_products_are_loaded_then_the_there_will_be_stored(): void
    {
        $productDTP = Mockery::mock(ProductDTO::class);
        $productDTP->allows()->toArray()->andReturn(['product_data']);

        $articleDTO = Mockery::mock(ArticleDTO::class);
        $articleDTO->allows()->toArray()->andReturn(['article_data']);
        $articleDTO->allows()->products()->andReturn(collect([$productDTP]));

        $article = Mockery::mock(Article::class);

        $this->provider->allows()->loadArticles()->andReturn(collect([$articleDTO]));
        $this->articleRepository->expects()->findByTitleOrCreate(['article_data'])->andReturn($article);
        $this->productRepository->expects()->findByNameOrCreate(['product_data'], $article)->andReturn(Mockery::mock(Product::class));

        $this->service()->crawl();
    }

    public function testProvider_should_return_the_provider(): void
    {
        static::assertSame($this->provider::class, $this->service()->provider());
    }

    protected function mockeryTestSetUp(): void
    {
        $this->provider = Mockery::mock(Provider::class);
        $this->articleRepository = Mockery::mock(ArticleRepository::class);
        $this->productRepository = Mockery::mock(ProductRepository::class);
    }

    private function service(): CrawlerService
    {
        return new CrawlerService(
            $this->provider,
            $this->articleRepository,
            $this->productRepository,
        );
    }
}