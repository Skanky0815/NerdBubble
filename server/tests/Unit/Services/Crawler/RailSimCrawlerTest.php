<?php

namespace Tests\Unit\Services\Crawler;

use App\Services\Crawler\RailSimCrawler;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

class RailSimCrawlerTest extends TestCase
{
    public function test_when_then(): void
    {
        Http::fake([
            'https://rail-sim.de/forum/wcf/' => Http::response(''),
        ]);

        $this->service()->crawl();
    }

    private function service(): RailSimCrawler
    {
        return new RailSimCrawler();
    }
}
