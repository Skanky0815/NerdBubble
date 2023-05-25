<?php declare(strict_types=1);

namespace App\Services\Crawler;

use App\Services\Crawler\DTO\Article;
use App\Services\Crawler\DTO\AsmodeeArticle;
use DOMDocument;
use DOMElement;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AssmodeeProvider implements Provider
{
    private const ASMODEE_HOME_URL = 'https://www.asmodee.de';
    private const ASMODEE_NEWS_URL = 'https://www.asmodee.de/_next/data/#HASH#/news.json';

    public function __construct(
        private readonly KeywordFilter $keywordFilter,
    ) {
    }

    public function loadArticles(): Collection
    {
        $hash = $this->loadHash();
        $newUrl = Str::replace('#HASH#', $hash, self::ASMODEE_NEWS_URL);
        $response = Http::get($newUrl)->json('pageProps');

        return collect($response['articles'])->map($this->mapToArticle(...))->filter($this->filter(...));
    }

    private function filter(Article $articleDto): bool
    {
        return $this->keywordFilter->matchKeyword($articleDto->filterText);
    }

    private function mapToArticle(array $articleData): Article
    {
        return AsmodeeArticle::create($articleData);
    }

    private function loadHash(): string
    {
        $response = Http::get(self::ASMODEE_HOME_URL);

        $dom = new DOMDocument();
        $dom->loadHTML($response->body());

        $scripts = collect($dom->getElementsByTagName('script'));

        /** @var DOMElement $neededScript */
        $neededScript = $scripts->firstOrFail(
            fn (DOMElement $element) => Str::contains($element->getAttribute('src'), '_buildManifest.js', true)
        );

        return Str::between($neededScript->getAttribute('src'), '/_next/static/', '/_buildManifest.js');
    }
}
