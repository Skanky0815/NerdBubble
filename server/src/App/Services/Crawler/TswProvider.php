<?php declare(strict_types=1);

namespace App\Services\Crawler;

use App\Services\Crawler\DTO\Article;
use App\Services\Crawler\DTO\TswArticle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class TswProvider implements Provider
{
    private const URL = 'https://cms.dovetailgames.com/api/v1/ghost/hub/tsw/web?limit=24&page=1';

    public function loadArticles(): Collection
    {
        $response = Http::get(self::URL)->json('posts');

        $mapToArticle = fn (array $content): Article => TswArticle::create($content);

        return collect($response['items'])->map($mapToArticle);
    }
}
