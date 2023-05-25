<?php declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Provider;
use App\Services\Crawler\DTO\RailSimArticle;
use App\Services\Crawler\Html\HtmlParser;
use App\Services\Crawler\RailSimProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\LegacyMockInterface;
use Tests\HtmlArticleFixture;
use Tests\TestCase;

class RailSimProviderTest extends TestCase
{
    use HtmlArticleFixture;
    use MockeryPHPUnitIntegration;

    private HtmlParser&LegacyMockInterface $htmlParser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->htmlParser = Mockery::mock(HtmlParser::class);
    }

    public function testLoadArticles_when_api_is_available_then_store_data_as_article_in_the_database(): void
    {
        Http::fake([
            'https://rail-sim.de/forum/wcf/train-sim-world-neuigkeiten/' => Http::response('content'),
        ]);

        $articleDto = $this->createHtmlArticle(<<<HTML
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
            ->andReturn(collect([$articleDto]));

        $allLoadedArticle = $this->service()->loadArticles();

        self::assertCount(1, $allLoadedArticle);

        $article = $allLoadedArticle->get(0);
        self::assertInstanceOf(RailSimArticle::class, $article);

        $articleData = $article->toArray();
        self::assertNotEmpty($articleData);
        self::assertSame(Provider::RAIL_SIM, $articleData['provider']);
        self::assertSame('[TSW3] Niddertalbahn: Bad Vilbel - Stockheim', $articleData['title']);
        self::assertSame('https://www.rail-sim.de/wp-content/uploads/2016/04/rail-sim_logo.png', $articleData['image']);
        self::assertSame('https://rail-sim.de/forum/thread/39263-tsw3-niddertalbahn-bad-vilbel-stockheim/', $articleData['link']);
        self::assertNull($articleData['subTitle']);
        self::assertNull($articleData['description']);
        self::assertInstanceOf(Carbon::class, $articleData['date']);
    }

    private function service(): RailSimProvider
    {
        return new RailSimProvider(
            $this->htmlParser,
        );
    }
}
