<?php declare(strict_types=1);

namespace App\Services\Crawler\Html;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Language;

class HtmlParser
{
    public function parse(#[Language('HTML')] string $html, #[Language('XPath')] string $rootNode): Collection
    {
        $xpath = $this->strToXpath($html);

        return collect($xpath->query($rootNode))->map(fn (DOMNode $node) => new HtmlContent($xpath, $node));
    }

    private function strToXpath(string $html): DOMXPath
    {
        $dom = new DOMDocument();
        $dom->loadHTML($html, LIBXML_NOERROR);

        return new DOMXpath($dom);
    }
}
