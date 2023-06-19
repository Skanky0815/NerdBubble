<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Provider;
use App\Services\Crawler\DTO\TswArticle;
use App\Services\Crawler\TswProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class TswProviderTest extends TestCase
{
    public function testGetArticlesWhenArticleDataFoundThenAArticleCollectionWillBeReturned(): void
    {
        Http::fake([
            'https://cms.dovetailgames.com/api/v1/ghost/hub/tsw/web?limit=24&page=1' => Http::response(<<<'JSON'
                  {
                    "posts": {
                      "items": [
                          {
                            "title": "Train Sim World 3 - Rheinland Revival",
                            "slug": "tsw3-rheinland-revival",
                            "images": {
                              "image": null,
                              "thumbWide": null,
                              "thumbSqr": null,
                              "ghostFeatured": "https://media.dovetailgames.com/1678379793513_TSW3_leftR_keyart_400x200.jpg"
                            },
                            "date": "2023-03-09T15:00:00.000Z",
                            "excerpt": "In this article we shall be taking you through all the fun nuances and layers you can look forward to in the Cross-City timetable!"
                          }
                      ]
                    }
                  }
                JSON),
        ]);

        $allArticles = $this->service()->loadArticles();

        self::assertCount(1, $allArticles);

        $article = $allArticles->get(0);

        self::assertInstanceOf(TswArticle::class, $article);

        $articleData = $article->toArray();

        self::assertNotEmpty($articleData);
        self::assertSame(Provider::TSW, $articleData['provider']);
        self::assertSame('Train Sim World 3 - Rheinland Revival', $articleData['title']);
        self::assertSame('https://media.dovetailgames.com/1678379793513_TSW3_leftR_keyart_400x200.jpg', $articleData['image']);
        self::assertSame('https://live.dovetailgames.com/live/train-sim-world/articles/article/tsw3-rheinland-revival', $articleData['link']);
        self::assertNull($articleData['subTitle']);
        self::assertSame('In this article we shall be taking you through all the fun nuances and layers you can look forward to in the Cross-City timetable!', $articleData['description']);
        self::assertInstanceOf(Carbon::class, $articleData['date']);
    }

    private function service(): TswProvider
    {
        return new TswProvider();
    }
}
