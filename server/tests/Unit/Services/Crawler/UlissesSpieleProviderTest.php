<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Provider;
use App\Services\Crawler\DTO\UlissesSpieleArticle;
use App\Services\Crawler\Html\HtmlParser;
use App\Services\Crawler\KeywordFilter;
use App\Services\Crawler\UlissesSpieleProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use Tests\HtmlArticleFixture;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class UlissesSpieleProviderTest extends TestCase
{
    use HtmlArticleFixture;
    use MockeryPHPUnitIntegration;

    private (HtmlParser&LegacyMockInterface)|(HtmlParser&MockInterface) $htmlParser;
    private (KeywordFilter&MockInterface)|(KeywordFilter&LegacyMockInterface) $keywordFilter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->htmlParser = \Mockery::mock(HtmlParser::class);
        $this->keywordFilter = \Mockery::mock(KeywordFilter::class);
    }

    public function testGetArticlesWhenArticleDataFoundThenAArticleCollectionWillBeReturned(): void
    {
        Http::fake([
            'https://ulisses-spiele.de/news/' => Http::response('content'),
        ]);

        $articleDto = $this->createHtmlArticle(<<<'HTML'
            <a href="https://ulisses-spiele.de/aventuria-stories-legends/"
               title="Aventuria Stories und Legends" class="entry-thumb">
                <img loading="lazy"
                     src="https://ulisses-spiele.de/wp-content/uploads/2022/11/01_Aventuria_Allgemein-256x143.webp"
                     alt="">
            </a>
            <div class="entry-body">
                <div class="entry-header">

                    <h2 class="h5 entry-title"><a
                            href="https://ulisses-spiele.de/aventuria-stories-legends/"
                            title="Aventuria Stories und Legends">some title</a></h2>

                </div>
                <div class="entry-meta">
                    <span class="entry-meta-date">10. November 2022</span>

                </div>
                <div class="entry-content p1">
                    <p>some text</p>
                </div>
            </div>
            HTML);

        $this->htmlParser->allows()
            ->parse('content', '//article[contains(@class, "post")]')
            ->andReturn(collect([$articleDto]))
        ;

        $this->keywordFilter->allows()->matchKeyword('some titlesome text')->andReturn(true);

        $allLoadedArticle = $this->service()->loadArticles();

        static::assertCount(1, $allLoadedArticle);

        $article = $allLoadedArticle->get(0);
        static::assertInstanceOf(UlissesSpieleArticle::class, $article);

        $articleData = $article->toArray();
        static::assertNotEmpty($articleData);
        static::assertSame(Provider::ULISSES_SPIELE, $articleData['provider']);
        static::assertSame('some title', $articleData['title']);
        static::assertSame('https://ulisses-spiele.de/wp-content/uploads/2022/11/01_Aventuria_Allgemein-256x143.webp', $articleData['image']);
        static::assertSame('https://ulisses-spiele.de/aventuria-stories-legends/', $articleData['link']);
        static::assertNull($articleData['subTitle']);
        static::assertSame('some text', $articleData['description']);
        static::assertInstanceOf(Carbon::class, $articleData['date']);
    }

    private function service(): UlissesSpieleProvider
    {
        return new UlissesSpieleProvider(
            $this->htmlParser,
            $this->keywordFilter,
        );
    }
}
