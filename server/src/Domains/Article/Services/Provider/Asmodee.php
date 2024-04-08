<?php

declare(strict_types=1);

namespace Domains\Article\Services\Provider;

use Carbon\CarbonImmutable;
use Domains\Article\Aggregates\Article;
use Domains\Article\Entities\Product;
use Domains\Article\Exceptions\ProviderException;
use Domains\Article\Factories\ArticleFactory;
use Domains\Article\Factories\ProductFactory;
use Domains\Article\Repositories\Articles;
use Domains\Article\Services\Crawler;
use Domains\Article\Services\Crawler\Filter\KeywordFilter;
use Domains\Article\Services\Crawler\Filter\ProductExistFilter;
use Domains\Article\Services\HttpClient;
use Domains\Article\ValueObjects\Provider;

class Asmodee implements Crawler
{
    private const ASMODEE_HOME_URL = 'https://www.asmodee.de';
    private const ASMODEE_NEWS_URL = 'https://www.asmodee.de/_next/data/%s/news.json';

    public function __construct(
        private readonly KeywordFilter $keywordFilter,
        private readonly ProductExistFilter $productExistFilter,
        private readonly Articles $articles,
        private readonly HttpClient $httpClient,
        private readonly ArticleFactory $articleFactory,
        private readonly ProductFactory $productFactory,
    ) {}

    public function crawl(): void
    {
        $newUrl = $this->loadNewsUrl();
        $response = $this->httpClient->loadContentFromWebsite($newUrl);

        $allArticles = $this->mapArrayToArticle($response['pageProps']['articles']);
        $filterArticles = $this->keywordFilter->removeArticlesWhoNotMatchAnyKeyword($allArticles);

        $this->articles->addAll(...$filterArticles);
    }

    private function loadNewsUrl(): string
    {
        $dom = $this->httpClient->loadContentFromWebsite(self::ASMODEE_HOME_URL);
        $scripts = $dom->getElementsByTagName('script');

        foreach ($scripts as $script) {
            if (1 === preg_match('/\/_next\/static\/(.*?)\/_buildManifest.js/', $script->getAttribute('src'), $match)) {
                return sprintf(self::ASMODEE_NEWS_URL, $match[1]);
            }
        }

        throw new ProviderException('No hash found for Asmodee news API call!');
    }

    private function mapArrayToArticle(array $allArticleData): array
    {
        $emptyProductContentFilter = static fn (array $productContent): bool => false === empty($productContent['product']);

        $mapping = function (array $articleData) use ($emptyProductContentFilter): Article {
            $contents = $articleData['content'] ?? [];
            $contentWithProduct = array_filter($contents, $emptyProductContentFilter);
            $allProducts = $this->createProductFromArray($contentWithProduct);
            $filteredProducts = $this->productExistFilter->removeKnownProducts($allProducts);

            return $this->createArticleFromArray($articleData, $filteredProducts);
        };

        return array_map($mapping, $allArticleData);
    }

    private function createArticleFromArray(array $articleData, array $products): Article
    {
        $linkCategory = empty($products) ? 'product' : 'news';

        return $this->articleFactory->setArticleData(
            provider: Provider::ASMODEE,
            headline: $articleData['headline'],
            publishDate: CarbonImmutable::parse($articleData['creationDate']),
            image: $articleData['tileImage']['formats']['small']['url'] ?? $articleData['tileImage']['url'],
            link: "https://www.asmodee.de/{$linkCategory}/{$articleData['slug']}",
            subHeadline: $articleData['subHeadline'],
        )->setProducts($products)
            ->build()
        ;
    }

    private function createProductFromArray(array $contentDatas): array
    {
        $mapping = fn (array $contentData): Product => $this->productFactory->setProductData(
            name: $contentData['product']['name'],
            link: 'https://www.asmodee.de/produkte/'.$contentData['product']['slug'],
            image: $contentData['product']['facets']['image'],
        )->build();

        return array_map($mapping, $contentDatas);
    }
}
