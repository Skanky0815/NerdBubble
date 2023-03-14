<?php declare(strict_types=1);

namespace App\Services\Crawler\Html;

use DOMDocument;
use DOMXPath;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Language;

class HtmlParser
{
    public function parse(#[Language('HTML')] string $html, #[Language('XPath')] string $rootNode): Collection
    {
        $xpath = $this->strToXpath($html);

        $articleElements = $xpath->query($rootNode);
        $allArticles = collect();
        foreach ($articleElements as $row) {
            $allArticles->add(new HtmlContent($xpath, $row));
        }

        return $allArticles;
    }

    private function strToXpath(string $html): DOMXPath
    {
        $dom = new DOMDocument();
        $dom->loadHTML($html, LIBXML_NOERROR);

        return new DOMXpath($dom);
    }
}
