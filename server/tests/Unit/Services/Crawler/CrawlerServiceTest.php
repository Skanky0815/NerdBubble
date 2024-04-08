<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Article;
use App\Models\Product;
use App\Repository\ArticleRepository;
use App\Repository\ProductRepository;
use App\Services\Crawler\CrawlerService;
use App\Services\Crawler\DTO\Article as ArticleDTO;
use App\Services\Crawler\DTO\Product as ProductDTO;
use App\Services\Crawler\Provider;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;

/**
 * @internal
 *
 * @coversNothing
 */
class CrawlerServiceTest extends MockeryTestCase
{
    private (LegacyMockInterface&Provider)|(MockInterface&Provider) $provider;
    private (ArticleRepository&LegacyMockInterface)|(ArticleRepository&MockInterface) $articleRepository;
    private (LegacyMockInterface&ProductRepository)|(MockInterface&ProductRepository) $productRepository;

    public function testCrawlWhenArticlesAndProductsAreLoadedThenTheThereWillBeStored(): void
    {
        $productDTP = \Mockery::mock(ProductDTO::class);
        $productDTP->allows()->toArray()->andReturn(['product_data']);

        $articleDTO = \Mockery::mock(ArticleDTO::class);
        $articleDTO->allows()->toArray()->andReturn(['article_data']);
        $articleDTO->allows()->products()->andReturn(collect([$productDTP]));

        $article = \Mockery::mock(Article::class);

        $this->provider->allows()->loadArticles()->andReturn(collect([$articleDTO]));
        $this->articleRepository->expects()->findByTitleOrCreate(['article_data'])->andReturn($article);
        $this->productRepository->expects()->findByNameOrCreate(['product_data'], $article)->andReturn(\Mockery::mock(Product::class));

        $this->service()->crawl();
    }

    public function testProviderShouldReturnTheProvider(): void
    {
        static::assertSame($this->provider::class, $this->service()->provider());
    }

    protected function mockeryTestSetUp(): void
    {
        $this->provider = \Mockery::mock(Provider::class);
        $this->articleRepository = \Mockery::mock(ArticleRepository::class);
        $this->productRepository = \Mockery::mock(ProductRepository::class);
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
