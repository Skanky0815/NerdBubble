<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler\Html\DTO;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Tests\HtmlArticleFixture;

/**
 * @internal
 *
 * @coversNothing
 */
class ArticleTest extends TestCase
{
    use HtmlArticleFixture;

    public function testFindElementWhenElementIsInDomThenItWillBeReturned(): void
    {
        $article = $this->createHtmlArticle('<div><h1><small>test</small></h1></div>');

        $element = $article->findElement('//div/h1/small');
        static::assertSame('test', $element->textContent);
    }

    public function testTextWhenElementFoundThenReturnTheTextContent(): void
    {
        $article = $this->createHtmlArticle('<div><h1><small>Foo   Bar </small></h1></div>');

        $text = $article->text('//div/h1/small');

        static::assertSame('Foo Bar', $text);
    }

    public function testLinkWhenElementFoundThenTheHrefWillReturned(): void
    {
        $article = $this->createHtmlArticle('<div><a href="link.to"></a></div>');

        $link = $article->link('//div/a');

        static::assertSame('link.to', $link);
    }

    public function testLinkWhenElementNotFoundThenAExceptionWillBeThrown(): void
    {
        $article = $this->createHtmlArticle('<div></div>');

        $this->expectException(\Throwable::class);

        $article->link();
    }

    public function testImageWhenElementFoundThenTheSrcWillReturned(): void
    {
        $article = $this->createHtmlArticle('<div><img src="image.jpg"></img></div>');

        $link = $article->image('//div/img');

        static::assertSame('image.jpg', $link);
    }

    public function testImageWhenElementNotFoundThenAExceptionWillBeThrown(): void
    {
        $article = $this->createHtmlArticle('<div></div>');

        $this->expectException(\Throwable::class);

        $article->image();
    }

    public function testDateWhenDateIsFoundInAttributeThenACarboneInstanceWillBeReturned(): void
    {
        $date = Carbon::create(2010);
        $article = $this->createHtmlArticle(
            sprintf(
                '<div><time datetime="%s"></time></div>',
                $date->format(DATE_RSS)
            )
        );

        $dateResult = $article->date('//div/time', DATE_RSS, attribute: 'datetime');

        static::assertSame($date->timestamp, $dateResult->timestamp);
    }

    public function testDateWhenDateIsFoundInTextContentThenACarboneInstanceWillBeReturned(): void
    {
        $article = $this->createHtmlArticle('<div><span>1 Januar 2010</span></div>');

        $dateResult = $article->date('//div/span', 'd M Y', 'de_DE');

        static::assertSame('2010-01-01', $dateResult->format('Y-m-d'));
    }

    public function testDateWhenDateIsNotFoundInTextContentThenACarboneInstanceWithCurrentTimeWillBeReturned(): void
    {
        $date = Carbon::create(2042);
        Carbon::setTestNow($date);

        $article = $this->createHtmlArticle('<div></div>');

        $dateResult = $article->date('//div/span', 'd M Y');

        static::assertSame($date->timestamp, $dateResult->timestamp);
    }
}
