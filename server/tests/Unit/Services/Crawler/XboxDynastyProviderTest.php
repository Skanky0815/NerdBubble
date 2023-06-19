<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Provider;
use App\Services\Crawler\DTO\XboxDynastyArticle;
use App\Services\Crawler\Html\HtmlParser;
use App\Services\Crawler\XboxDynastyProvider;
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
class XboxDynastyProviderTest extends TestCase
{
    use HtmlArticleFixture;
    use MockeryPHPUnitIntegration;

    private (HtmlParser&LegacyMockInterface)|(HtmlParser&MockInterface) $htmlParser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->htmlParser = \Mockery::mock(HtmlParser::class);
    }

    public function testGetArticlesWhenArticleDataFoundThenAArticleCollectionWillBeReturned(): void
    {
        Http::fake([
            'https://www.xboxdynasty.de/game/xbox-game-pass/' => Http::response('content'),
        ]);

        $articleDto = $this->createHtmlArticle(<<<'HTML'
            <div class="inner">
                <a class="post-thumbnail" href="xbox.link">
                    <img width="150" height="150" src="xbox.link.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="" loading="lazy" srcset="https://www.xboxdynasty.de/wp-content/uploads/2017/02/xbox-game-pass-17-150x150.jpeg.pagespeed.ce.2uUj5fj4K3.jpg 150w, https://www.xboxdynasty.de/wp-content/uploads/2017/02/xbox-game-pass-17-64x64.jpeg.pagespeed.ce.uqHVrORgNQ.jpg 64w" sizes="(max-width: 150px) 100vw, 150px" />
                </a>
                <div class="entry-aside">
                    <header class="entry-header">
                        <h1 class="entry-title"><a href="xbox.link">Xbox Game Pass: some title</a></h1>
                        <div class="entry-meta">
                            Autor: <span class="author"><a href="https://www.xboxdynasty.de/author/mrbudspencer/">Strohhut Bud</a></span>,
                            <time class="entry-date" datetime="">3. November 2023</time>
                        </div>
                    </header>
                    <div class="entry-content">
                        some description
                    </div>
                    <footer class="entry-meta">
                        <a class="btn btn-default btn-sm" href=""xbox.link">Weiterlesen</a>
                        <a href=""xbox.link/#comments" class="comments-link">13</a>
                    </footer>
                </div>
            </div>
            HTML);

        $this->htmlParser->allows()->parse('content', '//article')->andReturn(collect([$articleDto]));

        $allLoadedArticle = $this->service()->loadArticles();

        self::assertCount(1, $allLoadedArticle);

        $article = $allLoadedArticle->get(0);
        self::assertInstanceOf(XboxDynastyArticle::class, $article);

        $articleData = $article->toArray();
        self::assertNotEmpty($articleData);
        self::assertSame(Provider::XBOX_DYNASTY, $articleData['provider']);
        self::assertSame('some title', $articleData['title']);
        self::assertSame('xbox.link.jpg', $articleData['image']);
        self::assertSame('xbox.link', $articleData['link']);
        self::assertSame('some description', $articleData['subTitle']);
        self::assertNull($articleData['description']);
        self::assertInstanceOf(Carbon::class, $articleData['date']);
    }

    private function service(): XboxDynastyProvider
    {
        return new XboxDynastyProvider(
            $this->htmlParser,
        );
    }
}
