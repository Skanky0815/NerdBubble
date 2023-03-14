<?php declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Provider;
use App\Services\Crawler\DTO\TswArticle;
use App\Services\Crawler\TswProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TswProviderTest extends TestCase
{
    public function testGetArticles_when_article_data_found_then_a_article_collection_will_be_returned(): void
    {
        Http::fake([
            'https://cms.dovetailgames.com/api/v1/ghost/hub/tsw/web?limit=24&page=1' => Http::response(<<<JSON
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

        static::assertCount(1, $allArticles);

        $article = $allArticles->get(0);

        static::assertInstanceOf(TswArticle::class, $article);

        $articleData = $article->toArray();

        static::assertNotEmpty($articleData);
        static::assertSame(Provider::TSW, $articleData['provider']);
        static::assertSame('Train Sim World 3 - Rheinland Revival', $articleData['title']);
        static::assertSame('https://media.dovetailgames.com/1678379793513_TSW3_leftR_keyart_400x200.jpg', $articleData['image']);
        static::assertSame('https://live.dovetailgames.com/live/train-sim-world/articles/article/tsw3-rheinland-revival', $articleData['link']);
        static::assertNull($articleData['subTitle']);
        static::assertSame('In this article we shall be taking you through all the fun nuances and layers you can look forward to in the Cross-City timetable!', $articleData['description']);
        static::assertInstanceOf(Carbon::class, $articleData['date']);
    }

    private function service(): TswProvider
    {
        return new TswProvider();
    }
}
