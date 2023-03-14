<?php declare(strict_types=1);

namespace App\Services\Crawler;

use App\Repository\ProductRepository;
use App\Services\Crawler\DTO\FShopArticle;
use App\Services\Crawler\DTO\FShopProduct;
use App\Services\Crawler\DTO\Product;
use App\Services\Crawler\Html\HtmlContent;
use App\Services\Crawler\Html\HtmlParser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class FShopProvider implements Provider
{
    /*

        val products =
            newsMap(response, ".product--info", 4) { it.toProduct(".product--title", "srcset") }

        if (products.isNotEmpty()) {
            callback(
                News(
                    title = "F-Shop",
                    link = "https://www.f-shop.de/neuheiten/",
                    newsType = Provider.F_SHOP,
                    img = "https://www.f-shop.de/media/image/37/53/7c/logo_website_F_Shop_2.png",
                    date = LocalDate.now().toString(),
                    products = products,
                    tags = selectTags(products.allNames(), "Ulisses"),
                )
            )
        }
     */

    public function __construct(
        private readonly HtmlParser $htmlParser,
        private readonly KeywordFilter $keywordFilter,
        private readonly ProductRepository $productRepository,
    ) {
    }

    public function loadArticles(): Collection
    {
        $response = Http::get('https://www.f-shop.de/neuheiten/');
        $htmlContents = $this->htmlParser->parse($response->body(), './/div[contains(@class, "product--box")]');

        $mapToProduct = fn (HtmlContent $htmlContent): Product => FShopProduct::create($htmlContent);
        $filterKeyword = fn (Product $product): bool => $this->keywordFilter->matchKeyword($product->filterText);
        $filterNewProducts = fn (Product $product): bool => $this->productRepository->withNameNotExists($product->filterText);

        $newProducts = collect($htmlContents)->map($mapToProduct)->filter($filterKeyword)->filter($filterNewProducts);

        $articles = collect();
        if ($newProducts->isNotEmpty()) {
            $articles->add(FShopArticle::create(['products' => $newProducts]));
        }

        return $articles;
    }
}
