<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\ProviderType;
use App\Services\Crawler\DTO\RailSimArticle;
use App\Services\Crawler\Html\HtmlParser;
use App\Services\Crawler\RailSimProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\LegacyMockInterface;
use Tests\HtmlArticleFixture;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class RailSimProviderTest extends TestCase
{
    use HtmlArticleFixture;
    use MockeryPHPUnitIntegration;

    private HtmlParser&LegacyMockInterface $htmlParser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->htmlParser = \Mockery::mock(HtmlParser::class);
    }

    public function testLoadArticlesWhenApiIsAvailableThenStoreDataAsArticleInTheDatabase(): void
    {
        Http::fake([
            'https://rail-sim.de/forum/wcf/train-sim-world-neuigkeiten/' => Http::response('content'),
        ]);

        $articleDto = $this->createHtmlArticle(<<<'HTML'
            <ol>
                <li class="tabularListRow">
                    <ol>
                        <li class="columnSubject">
                            <h3>
                                <a href="https://rail-sim.de/forum/thread/39263-tsw3-niddertalbahn-bad-vilbel-stockheim/">[TSW3] Niddertalbahn: Bad Vilbel - Stockheim</a>
                            </h3>
                        <li class="columnLastPost">
                            <div>
                                <div>
                                    <small>
                                        <time datetime="2023-02-06T16:34:31+01:00">2023-02-06</time>
                                    </small>
                                </div>
                            </div>
                        </li>
                    </ol>
                </li>
            </ol>
            HTML);

        $this->htmlParser->allows()
            ->parse('content', '//li[@class="tabularListRow"]')
            ->andReturn(collect([$articleDto]))
        ;

        $allLoadedArticle = $this->service()->loadArticles();

        static::assertCount(1, $allLoadedArticle);

        $article = $allLoadedArticle->get(0);
        static::assertInstanceOf(RailSimArticle::class, $article);

        $articleData = $article->toArray();
        static::assertNotEmpty($articleData);
        static::assertSame(ProviderType::RAIL_SIM, $articleData['provider']);
        static::assertSame('[TSW3] Niddertalbahn: Bad Vilbel - Stockheim', $articleData['title']);
        static::assertSame('https://www.rail-sim.de/wp-content/uploads/2016/04/rail-sim_logo.png', $articleData['image']);
        static::assertSame('https://rail-sim.de/forum/thread/39263-tsw3-niddertalbahn-bad-vilbel-stockheim/', $articleData['link']);
        static::assertNull($articleData['subTitle']);
        static::assertNull($articleData['description']);
        static::assertInstanceOf(Carbon::class, $articleData['date']);
    }

    private function service(): RailSimProvider
    {
        return new RailSimProvider(
            $this->htmlParser,
        );
    }
}
