<?php declare(strict_types=1);

namespace App\Services\Crawler;

use App\Services\Crawler\DTO\Article;
use App\Services\Crawler\DTO\RailSimArticle;
use App\Services\Crawler\Html\HtmlContent;
use App\Services\Crawler\Html\HtmlParser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class RailSimProvider implements Provider
{
    private const HOME_URL = 'https://rail-sim.de/forum/wcf/train-sim-world-neuigkeiten/';

    public function __construct(
        private readonly HtmlParser $htmlParser,
    ) {
    }

    public function loadArticles(): Collection
    {
        $response = Http::get(self::HOME_URL);
        $allHtmlContents = $this->htmlParser->parse($response->body(), '//li[@class="tabularListRow"]');

        $mapToArticle = fn (HtmlContent $htmlContent): Article => RailSimArticle::create($htmlContent);

        return $allHtmlContents->map($mapToArticle);
    }
}
