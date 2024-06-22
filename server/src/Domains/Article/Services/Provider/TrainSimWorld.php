<?php

declare(strict_types=1);

namespace Domains\Article\Services\Provider;

use Carbon\CarbonImmutable;
use Domains\Article\Aggregates\Article;
use Domains\Article\Factories\ArticleFactory;
use Domains\Article\Repositories\Articles;
use Domains\Article\Services\Crawler;
use Domains\Article\Services\HttpClient;
use Domains\Article\ValueObjects\ProviderType;

class TrainSimWorld implements Crawler
{
    private const URL = 'https://cms.dovetailgames.com/api/v1/ghost/hub/tsw/web?limit=24&page=1';

    public function __construct(
        private readonly Articles $articles,
        private readonly HttpClient $httpClient,
        private readonly ArticleFactory $articleFactory,
    ) {}

    public function crawl(): void
    {
        $response = $this->httpClient->loadContentFromWebsite(self::URL);
        $articlesData = $response['posts']['items'];

        $mappedArticles = array_map($this->mapToArticle(...), $articlesData);

        $this->articles->addAll(...$mappedArticles);
    }

    public function provider(): string
    {
        return TrainSimWorld::class;
    }

    private function mapToArticle(array $articleData): Article
    {
        $selectImage = fn (array $img): string => $img['thumbSqr']
            ?: $img['thumbWide']
                ?: $img['ghostFeatured']
                    ?: '';

        return $this->articleFactory->setArticleData(
            provider: ProviderType::TSW,
            headline: $articleData['title'],
            publishDate: CarbonImmutable::parse($articleData['date']),
            image: $selectImage($articleData['images']),
            link: 'https://live.dovetailgames.com/live/train-sim-world/articles/article/'.$articleData['slug'],
            description: $articleData['excerpt'],
        )->build();
    }
}
