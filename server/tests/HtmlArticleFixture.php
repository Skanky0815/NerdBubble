<?php

declare(strict_types=1);

namespace Tests;

use App\Services\Crawler\Html\HtmlContent;
use JetBrains\PhpStorm\Language;

trait HtmlArticleFixture
{
    public function createHtmlArticle(#[Language('HTML')] string $html): HtmlContent
    {
        $dom = new \DOMDocument();
        $dom->loadHTML(sprintf('<div>%s</div>', $html), LIBXML_NOERROR);

        $rootElement = $dom->getElementsByTagName('div')->item(0);
        $xpath = new \DOMXPath($dom);

        return new HtmlContent($xpath, $rootElement);
    }
}
