<?php

declare(strict_types=1);

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
    public function __construct(
        private readonly HtmlParser $htmlParser,
        private readonly KeywordFilter $keywordFilter,
        private readonly ProductRepository $productRepository,
    ) {}

    public function loadArticles(): Collection
    {
        $response = Http::get('https://www.f-shop.de/neuheiten/');
        $htmlContents = $this->htmlParser->parse($response->body(), './/div[contains(@class, "product--box")]');

        $mapToProduct = fn (HtmlContent $htmlContent): Product => FShopProduct::create($htmlContent);
        $filterKeyword = fn (Product $product): bool => $this->keywordFilter->matchKeyword($product->filterText);
        $filterNewProducts = fn (Product $product): bool => $this->productRepository->withTheGivenNameDoNotExist($product->getName());

        $newProducts = collect($htmlContents)->map($mapToProduct)->filter($filterKeyword)->filter($filterNewProducts);

        $articles = collect();
        if ($newProducts->isNotEmpty()) {
            $articles->add(FShopArticle::create(['products' => $newProducts]));
        }

        return $articles;
    }
}
