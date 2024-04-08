<?php

declare(strict_types=1);

namespace App\Services\Crawler;

use App\Services\Crawler\DTO\Article;
use App\Services\Crawler\DTO\UlissesSpieleArticle;
use App\Services\Crawler\Html\HtmlContent;
use App\Services\Crawler\Html\HtmlParser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class UlissesSpieleProvider implements Provider
{
    private const HOME_URL = 'https://ulisses-spiele.de/news/';

    public function __construct(
        private readonly HtmlParser $htmlParser,
        private readonly KeywordFilter $keywordFilter,
    ) {}

    public function loadArticles(): Collection
    {
        $response = Http::get(self::HOME_URL);

        $htmlContents = $this->htmlParser->parse($response->body(), '//article[contains(@class, "post")]');

        $mapToArticle = fn (HtmlContent $htmlContent): Article => UlissesSpieleArticle::create($htmlContent);
        $filter = fn (Article $article): bool => $this->keywordFilter->matchKeyword($article->filterText);

        return $htmlContents->map($mapToArticle)->filter($filter);
    }
}
