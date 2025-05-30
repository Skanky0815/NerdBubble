<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Repository\ProductRepository;
use App\Services\Crawler\BlueBrixxProvider;
use App\Services\Crawler\DTO\BlueBrixxArticle;
use App\Services\Crawler\DTO\BlueBrixxProduct;
use App\Services\Crawler\Html\HtmlParser;
use App\Services\Crawler\KeywordFilter;
use Illuminate\Support\Facades\Http;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\HtmlArticleFixture;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class BlueBrixxProviderTest extends TestCase
{
    use HtmlArticleFixture;
    use MockeryPHPUnitIntegration;

    private (HtmlParser&LegacyMockInterface)|(HtmlParser&MockInterface) $htmlParser;
    private (LegacyMockInterface&ProductRepository)|(MockInterface&ProductRepository) $productRepository;
    private (KeywordFilter&LegacyMockInterface)|(KeywordFilter&MockInterface) $keywordFilter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->htmlParser = \Mockery::mock(HtmlParser::class);
        $this->productRepository = \Mockery::mock(ProductRepository::class);
        $this->keywordFilter = \Mockery::mock(KeywordFilter::class);
    }

    #[Test]
    public function getArticlesWhenProductsAreNewThenANewArticleWithProductsWillCreated(): void
    {
        Http::fake([
            'https://www.bluebrixx.com/de/ankuendigungen?limit=32' => Http::response('content'),
        ]);

        $productDto = $this->createHtmlArticle(<<<'HTML'
            <div class="category" style="text-align:left;">
                <div class="catImg catImg158">

                <div class="label_parts">1544 PCS</div>
                    <a href="bluebrixx-article.link" class="" data-itemno="105543" style="text-align:center;">
                        <img src="bluebrixx-product-bild.jpg" alt="Quantum Colony: Container Shuttle &quot;Vulture&quot;" class="" style="">
                    </a>
                    <div class="addItemCart cartIconBtn" data-itemno="105543"><i class="material-icons md-24">add_shopping_cart</i></div>
                </div>

                <div class="catText">
                    <a href="bluebrixx-article.link" class="" data-itemno="105543">
                        <div class="searchItemData">
                            <div class="searchItemTitle">ProductName</div>
                            <div class="searchItemInfo">
                                <div class="searchItemDesc">BlueBrixx-Special</div>
                                <div class="searchItemPrices">
                                    <span class="regPrice">59,95 EUR*</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="catButtons"></div>
            </div>
            HTML);
        $this->htmlParser->allows()->parse('content', '//div[@class="category"]')->andReturn(collect([$productDto]));
        $this->productRepository->allows()->withTheGivenNameDoNotExist(\Mockery::any())->andReturn(true);
        $this->keywordFilter->allows()->matchKeyword('ProductName')->andReturn(true);

        $allArticles = $this->service()->loadArticles();

        static::assertCount(1, $allArticles);

        $article = $allArticles->get(0);
        static::assertInstanceOf(BlueBrixxArticle::class, $article);

        static::assertCount(1, $article->products());
        $product = $article->products()->get(0);
        static::assertInstanceOf(BlueBrixxProduct::class, $product);
        $productData = $product->toArray();

        static::assertNotEmpty($productData);

        static::assertSame('ProductName', $productData['name']);
        static::assertSame('bluebrixx-article.link', $productData['link']);
        static::assertSame('bluebrixx-product-bild.jpg', $productData['image']);
    }

    #[Test]
    public function getArticlesWhenProductsIsKonwnThenANewArticleWithProductsWillCreated(): void
    {
        Http::fake([
            'https://www.bluebrixx.com/de/ankuendigungen?limit=32' => Http::response('content'),
        ]);

        $productDto = $this->createHtmlArticle(<<<'HTML'
            <div class="category" style="text-align:left;">
                <div class="catImg catImg158">

                <div class="label_parts">1544 PCS</div>
                    <a href="bluebrixx-article.link" class="" data-itemno="105543" style="text-align:center;">
                        <img src="bluebrixx-product-bild.jpg" alt="Quantum Colony: Container Shuttle &quot;Vulture&quot;" class="" style="">
                    </a>

                    <div class="addItemCart cartIconBtn" data-itemno="105543"><i class="material-icons md-24">add_shopping_cart</i></div>
                </div>

                <div class="catText">
                    <a href="bluebrixx-article.link" class="" data-itemno="105543">
                        <div class="searchItemData">
                            <div class="searchItemTitle">ProductName</div>
                            <div class="searchItemInfo">
                                <div class="searchItemDesc">BlueBrixx-Special</div>

                                <div class="searchItemPrices">
                                    <span class="regPrice">59,95 EUR*</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="catButtons"></div>
            </div>
            HTML);
        $this->htmlParser->allows()->parse('content', '//div[@class="category"]')->andReturn(collect([$productDto]));
        $this->productRepository->allows()->withTheGivenNameDoNotExist(\Mockery::any())->andReturn(false);

        $allArticles = $this->service()->loadArticles();

        static::assertEmpty($allArticles);
    }

    private function service(): BlueBrixxProvider
    {
        return new BlueBrixxProvider(
            $this->htmlParser,
            $this->productRepository,
            $this->keywordFilter,
        );
    }
}
