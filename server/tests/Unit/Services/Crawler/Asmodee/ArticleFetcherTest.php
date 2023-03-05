<?php

namespace Tests\Unit\Services\Crawler\Asmodee;

use App\Services\Crawler\Asmodee\ArticleFetcher;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ArticleFetcherTest extends TestCase
{
    public function test_fetchAll_when_then(): void
    {
        Http::fake([
            'https://www.asmodee.de' => Http::response('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>'),
            'https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json' => Http::response(<<<JSON
                {
                  "pageProps": {
                    "articles": [
                      {
                        "headline":"test",
                        "subHeadline":"sub test line",
                        "content":[],
                        "slug":"noooo",
                        "creationDate":"1984-01-01",
                        "tileImage": {
                          "formats": {
                            "small": {
                              "url": "image-url.png"
                            }
                          }
                        }
                      }
                    ]
                  }
                }
            JSON),
        ]);

        $result = $this->service()->fetchAll();

        $this->assertSame(1, $result->count());
    }

    private function service(): ArticleFetcher
    {
        return new ArticleFetcher();
    }
}
