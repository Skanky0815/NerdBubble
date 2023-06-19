<?php

declare(strict_types=1);

namespace App\Services\Crawler;

use App\Services\Crawler\DTO\Article;
use App\Services\Crawler\DTO\XboxDynastyArticle;
use App\Services\Crawler\Html\HtmlContent;
use App\Services\Crawler\Html\HtmlParser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class XboxDynastyProvider implements Provider
{
    private const HOME_URL = 'https://www.xboxdynasty.de/game/xbox-game-pass/';

    public function __construct(
        private readonly HtmlParser $htmlParser,
    ) {
    }

    public function loadArticles(): Collection
    {
        $response = Http::get(self::HOME_URL);
        $htmlContents = $this->htmlParser->parse($response->body(), '//article');

        $mapToArticle = fn (HtmlContent $htmlContent): Article => XboxDynastyArticle::create($htmlContent);

        return $htmlContents->map($mapToArticle);
    }
}
