<?php

declare(strict_types=1);

namespace App\Services\Crawler;

use App\Repository\ArticleRepository;
use App\Repository\ProductRepository;
use App\Services\Crawler\DTO\Article as ArticleDTO;
use App\Services\Crawler\DTO\Product as ProductDTO;

class CrawlerService implements Crawler
{
    public function __construct(
        private readonly Provider $provider,
        private readonly ArticleRepository $articleRepository,
        private readonly ProductRepository $productRepository,
    ) {
    }

    public function provider(): string
    {
        return $this->provider::class;
    }

    public function crawl(): void
    {
        $allArticleDTOs = $this->provider->loadArticles();

        $allArticleDTOs->each(function (ArticleDTO $articleDTO): void {
            $article = $this->articleRepository->findByTitleOrCreate($articleDTO->toArray());

            $articleDTO->products()->each(function (ProductDTO $productDTO) use ($article): void {
                $this->productRepository->findByNameOrCreate($productDTO->toArray(), $article);
            });
        });
    }
}
