<?php declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Repository\ProductRepository;
use App\Services\Crawler\BlueBrixxProvider;
use App\Services\Crawler\DTO\BlueBrixxArticle;
use App\Services\Crawler\DTO\BlueBrixxProduct;
use App\Services\Crawler\Html\HtmlParser;
use App\Services\Crawler\KeywordFilter;
use Illuminate\Support\Facades\Http;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\HtmlArticleFixture;
use Tests\TestCase;

class BlueBrixxProviderTest extends TestCase
{
    use HtmlArticleFixture;
    use MockeryPHPUnitIntegration;

    private (HtmlParser&LegacyMockInterface)|(HtmlParser&MockInterface) $htmlParser;
    private (ProductRepository&MockInterface)|(ProductRepository&LegacyMockInterface) $productRepository;
    private (KeywordFilter&MockInterface)|(KeywordFilter&LegacyMockInterface) $keywordFilter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->htmlParser = Mockery::mock(HtmlParser::class);
        $this->productRepository = Mockery::mock(ProductRepository::class);
        $this->keywordFilter = Mockery::mock(KeywordFilter::class);
    }

    #[Test]
    public function getArticles_when_products_are_new_then_a_new_article_with_products_will_created(): void
    {
        Http::fake([
            'https://www.bluebrixx.com/de/neuheiten?limit=32' => Http::response('content'),
        ]);

        $productDto = $this->createHtmlArticle(<<<HTML
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
        $this->htmlParser->allows()->parse('content', '//div[@id="shopsearchItems"]')->andReturn(collect([$productDto]));
        $this->productRepository->allows()->withTheGivenNameDoNotExist(Mockery::any())->andReturn(true);
        $this->keywordFilter->allows()->matchKeyword('ProductName')->andReturn(true);

        $allArticles = $this->service()->loadArticles();

        self::assertCount(1, $allArticles);

        $article = $allArticles->get(0);
        self::assertInstanceOf(BlueBrixxArticle::class, $article);

        self::assertCount(1, $article->products());
        $product = $article->products()->get(0);
        self::assertInstanceOf(BlueBrixxProduct::class, $product);
        $productData = $product->toArray();

        self::assertNotEmpty($productData);

        self::assertSame('ProductName', $productData['name']);
        self::assertSame('bluebrixx-article.link', $productData['link']);
        self::assertSame('bluebrixx-product-bild.jpg', $productData['image']);
    }

    #[Test]
    public function getArticles_when_products_is_konwn_then_a_new_article_with_products_will_created(): void
    {
        Http::fake([
            'https://www.bluebrixx.com/de/neuheiten?limit=32' => Http::response('content'),
        ]);

        $productDto = $this->createHtmlArticle(<<<HTML
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
        $this->htmlParser->allows()->parse('content', '//div[@id="shopsearchItems"]')->andReturn(collect([$productDto]));
        $this->productRepository->allows()->withTheGivenNameDoNotExist(Mockery::any())->andReturn(false);

        $allArticles = $this->service()->loadArticles();

        self::assertEmpty($allArticles);
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
