<?php

namespace App\Services\Crawler;

use App\Models\Article;
use App\Models\Product;
use App\Services\Crawler\Asmodee\ArticleFetcher;
use App\Services\Crawler\Asmodee\DTO\Article as ArticleDTO;
use App\Services\Crawler\Asmodee\DTO\Product as ProductDto;

class AsmodeeCrawler implements Crawler
{
    private const ASMODEE_HOME_URL = 'https://www.asmodee.de';

    public function __construct(
        private readonly KeywordFilter $keywordFilter,
        private readonly ArticleFetcher $articleFetcher,
    ) {
    }

    public function crawl(): void
    {
        $allArticleDto = $this->articleFetcher->fetchAll();

        $allArticleDto->each(function (ArticleDTO $articleDto) {
            if ($this->keywordFilter->matchKeyword($articleDto->filterText)) {
                $article = $this->createArticle($articleDto);
                $this->createProduct($articleDto, $article);
            }
        });
    }

    private function createArticle(ArticleDTO $articleDto): Article
    {
        return Article::create([
            'title' => $articleDto->headline,
            'subTitle' => $articleDto->subHeadline,
            'link' => self::ASMODEE_HOME_URL.'/news/'.$articleDto->slug,
            'date' => $articleDto->creationDate,
            'image' => $articleDto->image,
            'newsType' => 'ASMODEE',
        ]);
    }

    private function createProduct(ArticleDTO $articleDto, Article $article): void
    {
        $articleDto->products->each(function (ProductDto $productDto) use ($article) {
            if ($this->keywordFilter->matchKeyword($productDto->name)) {
                Product::create([
                    'article_id' => $article->id,
                    'title' => $productDto->name,
                    'link' => self::ASMODEE_HOME_URL.'/produkte/'.$productDto->slug,
                    'image' => $productDto->image,
                ]);
            }
        });
    }
}
