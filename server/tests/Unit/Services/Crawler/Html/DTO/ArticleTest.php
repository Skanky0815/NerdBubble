<?php declare(strict_types=1);

namespace Tests\Unit\Services\Crawler\Html\DTO;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Tests\HtmlArticleFixture;
use Throwable;

class ArticleTest extends TestCase
{
    use HtmlArticleFixture;

    public function testFindElement_when_element_is_in_dom_then_it_will_be_returned(): void
    {
        $article = $this->createHtmlArticle('<div><h1><small>test</small></h1></div>');

        $element = $article->findElement('//div/h1/small');
        self::assertSame('test', $element->textContent);
    }

    public function testText_when_element_found_then_return_the_text_content(): void
    {
        $article = $this->createHtmlArticle('<div><h1><small>Foo   Bar </small></h1></div>');

        $text = $article->text('//div/h1/small');

        self::assertSame('Foo Bar', $text);
    }

    public function testLink_when_element_found_then_the_href_will_returned(): void
    {
        $article = $this->createHtmlArticle('<div><a href="link.to"></a></div>');

        $link = $article->link('//div/a');

        self::assertSame('link.to', $link);
    }

    public function testLink_when_element_not_found_then_a_exception_will_be_thrown(): void
    {
        $article = $this->createHtmlArticle('<div></div>');

        $this->expectException(Throwable::class);

        $article->link();
    }

    public function testImage_when_element_found_then_the_src_will_returned(): void
    {
        $article = $this->createHtmlArticle('<div><img src="image.jpg"></img></div>');

        $link = $article->image('//div/img');

        self::assertSame('image.jpg', $link);
    }

    public function testImage_when_element_not_found_then_a_exception_will_be_thrown(): void
    {
        $article = $this->createHtmlArticle('<div></div>');

        $this->expectException(Throwable::class);

        $article->image();
    }

    public function testDate_when_date_is_found_in_attribute_then_a_carbone_instance_will_be_returned(): void
    {
        $date = Carbon::create(2010);
        $article = $this->createHtmlArticle(
            sprintf(
                '<div><time datetime="%s"></time></div>',
                $date->format(DATE_RSS)
            )
        );

        $dateResult = $article->date('//div/time', DATE_RSS, attribute: 'datetime');

        self::assertSame($date->timestamp, $dateResult->timestamp);
    }

    public function testDate_when_date_is_found_in_textContent_then_a_carbone_instance_will_be_returned(): void
    {
        $article = $this->createHtmlArticle('<div><span>1 Januar 2010</span></div>');

        $dateResult = $article->date('//div/span', 'd M Y', 'de_DE');

        self::assertSame('2010-01-01', $dateResult->format('Y-m-d'));
    }

    public function testDate_when_date_is_not_found_in_textContent_then_a_carbone_instance_with_current_time_will_be_returned(): void
    {
        $date = Carbon::create(2042);
        Carbon::setTestNow($date);

        $article = $this->createHtmlArticle('<div></div>');

        $dateResult = $article->date('//div/span', 'd M Y');

        self::assertSame($date->timestamp, $dateResult->timestamp);
    }
}
