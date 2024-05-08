<?php

declare(strict_types=1);

namespace App\Services\Crawler;

use App\Repository\ProductRepository;
use App\Services\Crawler\DTO\BlueBrixxArticle;
use App\Services\Crawler\DTO\BlueBrixxProduct;
use App\Services\Crawler\DTO\Product;
use App\Services\Crawler\Html\HtmlContent;
use App\Services\Crawler\Html\HtmlParser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class BlueBrixxProvider implements Provider
{
    public function __construct(
        private readonly HtmlParser $htmlParser,
        private readonly ProductRepository $productRepository,
        private readonly KeywordFilter $keywordFilter
    ) {}

    public function loadArticles(): Collection
    {
        $response = Http::get('https://www.bluebrixx.com/de/ankuendigungen?limit=32');

        $htmlContents = $this->htmlParser->parse($response->body(), '//div[@class="category"]');

        $mapToProduct = fn (HtmlContent $htmlContent): Product => BlueBrixxProduct::create($htmlContent);

        $filterKeyword = fn (Product $product): bool => $this->keywordFilter->matchKeyword($product->filterText);
        $filterNewProducts = fn (Product $product): bool => $this->productRepository->withTheGivenNameDoNotExist($product->getName());

        $newProducts = collect($htmlContents)->map($mapToProduct)->filter($filterNewProducts)->filter($filterKeyword);

        $articles = collect();
        if ($newProducts->isNotEmpty()) {
            $articles->add(BlueBrixxArticle::create(['products' => $newProducts]));
        }

        return $articles;
    }
}
