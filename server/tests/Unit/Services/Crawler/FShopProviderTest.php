<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Repository\ProductRepository;
use App\Services\Crawler\DTO\FShopArticle;
use App\Services\Crawler\DTO\FShopProduct;
use App\Services\Crawler\FShopProvider;
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
class FShopProviderTest extends TestCase
{
    use HtmlArticleFixture;
    use MockeryPHPUnitIntegration;

    private (HtmlParser&LegacyMockInterface)|(HtmlParser&MockInterface) $htmlParser;
    private (KeywordFilter&MockInterface)|(KeywordFilter&LegacyMockInterface) $keywordFilter;
    private (ProductRepository&MockInterface)|(ProductRepository&LegacyMockInterface) $productRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->htmlParser = \Mockery::mock(HtmlParser::class);
        $this->keywordFilter = \Mockery::mock(KeywordFilter::class);
        $this->productRepository = \Mockery::mock(ProductRepository::class);
    }

    #[Test]
    public function getArticles_when_article_data_found_then_a_article_collection_will_be_returned(): void
    {
        Http::fake([
            'https://www.f-shop.de/neuheiten/' => Http::response('content'),
        ]);

        $articleDto = $this->createHtmlArticle(<<<'HTML'
            <div class="box--content is--rounded">
                <div class="product--badges">
                    <div class="product--badge badge--newcomer">NEU</div>
                </div>
                <div class="product--info">
                    <a href="aventuria-article.link" title="Aventuria" class="product--image" >
                        <span class="image--element">
                            <span class="image--media">
                                <img srcset="aventuria-product-bild.jpg" alt="US25957_0.JPG" title="US25957_0.JPG" />
                            </span>
                        </span>
                    </a>
                    <div class="arb--icons-productbox">
                        <div class="language--flag de_DE"></div>
                        <img src="https://www.f-shop.de/media/image/15/31/02/dsa_30px.png" />
                    </div>
                    <a href="f-shop.de/produkt-link" class="product--title" title="Aventuria">
                        Aventuria
                    </a>
                    <div class="product--delivery">
                        <link itemprop="availability" href="http://schema.org/PreOrder" />
                        <p class="delivery--information">
                            <span class="delivery--text delivery--text-more-is-coming">
                                <i class="delivery--status-icon delivery--status-more-is-coming"></i>
                                Erscheint im Juni 2023                                        <br/>Vorbestellung möglich
                            </span>
                        </p>
                    </div>
                    <div class="arb--product-actions--wrapper">
                        <div class="product--price-info">
                            <div class="product--price-outer">
                                <div class="product--price">
                                    <span class="price--default is--nowrap">19,95&nbsp;&euro;*</span>
                                </div>
                            </div>
                        </div>
                        <div class="product--actions">
                            <div class="arb--buynow-product">
                                <form  name="sAddToBasket" method="post" class="buybox--form" data-add-article="true" data-eventName="submit" data-showModal="false" data-addArticleUrl="https://www.f-shop.de/checkout/ajaxAddArticleCart">
                                    <div class="arb--quantity">
                                        <input type="number" class="arb--quantity-input" name="sQuantity" step=1 value=1 max=100 min=1>
                                        <div class="quantity-nav">
                                            <div class="quantity-button quantity-up"></div>
                                            <div class="quantity-button quantity-down"></div>
                                        </div>
                                    </div>
                                    <button class="buybox--button btn" name="In den Warenkorb">
                                        <div class="icon--basket"></div>
                                    </button>
                                    <input type="hidden" name="sActionIdentifier" value="">
                                    <input type="hidden" name="sAddAccessories" id="sAddAccessories" value="">
                                    <input type="hidden" name="sAdd" value="US25957">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            HTML);

        $this->htmlParser->allows()->parse('content', './/div[contains(@class, "product--box")]')->andReturn(collect([$articleDto]));
        $this->productRepository->allows()->withTheGivenNameDoNotExist(\Mockery::any())->andReturn(true);
        $this->keywordFilter->allows()->matchKeyword('Aventuria')->andReturn(true);

        $allArticles = $this->service()->loadArticles();

        self::assertCount(1, $allArticles);

        $article = $allArticles->get(0);
        self::assertInstanceOf(FShopArticle::class, $article);

        self::assertCount(1, $article->products());
        $product = $article->products()->get(0);
        self::assertInstanceOf(FShopProduct::class, $product);
        $productData = $product->toArray();

        self::assertNotEmpty($productData);

        self::assertSame('Aventuria', $productData['name']);
        self::assertSame('aventuria-article.link', $productData['link']);
        self::assertSame('aventuria-product-bild.jpg', $productData['image']);
    }

    private function service(): FShopProvider
    {
        return new FShopProvider(
            $this->htmlParser,
            $this->keywordFilter,
            $this->productRepository,
        );
    }
}
