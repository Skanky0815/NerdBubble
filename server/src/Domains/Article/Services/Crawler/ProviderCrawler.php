<?php

declare(strict_types=1);

namespace Domains\Article\Services\Crawler;

use Domains\Article\Aggregates\Provider;
use Domains\Article\Exceptions\HtmlParserException;
use Domains\Article\Factories\ArticleFactory;
use Domains\Article\Repositories\Articles;
use Domains\Article\Repositories\Providers;
use Domains\Article\Services\Crawler;
use Domains\Article\Services\Crawler\Filter\KeywordFilter;
use Domains\Article\Services\HttpClient;
use Domains\Article\ValueObjects\HtmlNode;
use Domains\Article\ValueObjects\ProviderType;

class ProviderCrawler implements Crawler
{
    public function __construct(
        private readonly Providers $providers,
        private readonly HttpClient $httpClient,
        private readonly ArticleFactory $articleFactory,
        private readonly KeywordFilter $keywordFilter,
        private readonly Articles $articles,
    ) {}

    public function crawl(): void
    {
        $providers = $this->providers->allActiveWithKeywords();

        foreach ($providers as $provider) {
            $this->foo($provider);
        }
    }

    public function provider(): string
    {
        return ProviderCrawler::class;
    }

    private function foo(Provider $provider): void
    {
        $dom = $this->httpClient->loadContentFromWebsite($provider->aggregateUrl);

        $xPath = new \DOMXPath($dom);

        $rootElements = $xPath->query($provider->articleSelector->wrapper);

        $articles = [];
        foreach ($rootElements as $rootElement) {
            $htmlNode = new HtmlNode($xPath, $rootElement);
            $articleSelector = $provider->articleSelector;

            try {
                $image = $provider->articleImage ?: $htmlNode->image($articleSelector->image);
            } catch (HtmlParserException $exception) {
                $image = $provider->logoImage;
            }

            $article = $this->articleFactory->setArticleData(
                provider: ProviderType::DEFAULT,
                headline: $provider->articleHeadline ?: $htmlNode->text($articleSelector->headline),
                publishDate: $htmlNode->date($articleSelector->dateSelector),
                image: $image,
                link: $provider->articleLink ?: $htmlNode->link($articleSelector->link),
                subHeadline: $articleSelector->hasSubHeadlineSelector() ? $htmlNode->text($articleSelector->subHeadline) : null,
                description: $articleSelector->hasDescriptionSelector() ? $htmlNode->text($articleSelector->description) : null,
            )->build();

            if ($this->articles->withTheGivenHeadlineDoNotExist($article->headline)) {
                $articles[] = $article;
            }
        }

        $filterArticles = $this->keywordFilter->removeArticlesWhoNotMatchAnyKeyword($articles);

        $this->articles->addAll(...$filterArticles);
    }
}
