<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler\Html;

use App\Services\Crawler\Html\HtmlContent;
use App\Services\Crawler\Html\HtmlParser;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class HtmlParserTest extends TestCase
{
    public function testParseWhenTheDocumentIsLoadedThenTheFoundedElementsReturnedAsArrayCollection(): void
    {
        $allArticles = $this->service()->parse(
            '<div><selction>A</selction><selction>B</selction></div>',
            '//selction'
        );

        self::assertCount(2, $allArticles);
        self::assertInstanceOf(HtmlContent::class, $allArticles->get(0));
    }

    private function service(): HtmlParser
    {
        return new HtmlParser();
    }
}
