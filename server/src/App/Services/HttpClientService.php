<?php

declare(strict_types=1);

namespace App\Services;

use Domains\Article\Services\HttpClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class HttpClientService implements HttpClient
{
    public function loadContentFromWebsite(string $url): array|\DOMDocument
    {
        $response = Http::get($url);

        $content = $response->body();
        if (Str::isJson($content)) {
            return $response->json();
        }

        $dom = new \DOMDocument();
        $dom->loadHTML($content);

        return $dom;
    }
}
