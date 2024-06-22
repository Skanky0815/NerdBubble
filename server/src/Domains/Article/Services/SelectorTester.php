<?php

declare(strict_types=1);

namespace Domains\Article\Services;

use Domains\Article\Exceptions\HtmlParserException;
use Domains\Article\ValueObjects\ArticleSelector;
use Domains\Article\ValueObjects\HtmlNode;

class SelectorTester
{
    public function __construct(
        private readonly HttpClient $httpClient,
    ) {}

    public function crawl(string $aggregateUrl, ArticleSelector $articleSelector): array
    {
        $dom = $this->httpClient->loadContentFromWebsite($aggregateUrl);

        $xPath = new \DOMXPath($dom);

        $rootElement = $xPath->query($articleSelector->wrapper);

        $node = new HtmlNode($xPath, $rootElement->item(0));

        try {
            return [
                'countArticle' => $rootElement->count(),
                'article' => [
                    'headline' => null === $articleSelector->headline ? null : $node->text($articleSelector->headline),
                    'date' => null === $articleSelector->dateSelector ? null : $node->date($articleSelector->dateSelector)->format('Y-m-d'),
                    'image' => null === $articleSelector->image ? null : $node->image($articleSelector->image),
                    'link' => null === $articleSelector->link ? null : $node->link($articleSelector->link),
                    'subHeadline' => null === $articleSelector->subHeadline ? null : $node->text($articleSelector->subHeadline),
                    'description' => null === $articleSelector->description ? null : $node->text($articleSelector->description),
                ],
            ];
        } catch (HtmlParserException $e) {
            dd([
                'message' => $e->getMessage(),
                'html' => $e->root,
            ]);
        }
    }
}
