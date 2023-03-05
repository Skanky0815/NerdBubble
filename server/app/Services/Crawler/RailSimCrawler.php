<?php

namespace App\Services\Crawler;

use Illuminate\Support\Facades\Http;

class RailSimCrawler implements Crawler
{
    private const HOME_URL = 'https://rail-sim.de/forum/wcf/';
    public function crawl(): void
    {
        $response = Http::get(self::HOME_URL);
    }
}
