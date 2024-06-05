<?php

declare(strict_types=1);

namespace Domains\Article\Exceptions;

class HtmlParserException extends \RuntimeException implements ArticleException
{
    private function __construct(string $msg, public readonly string $root)
    {
        parent::__construct($msg);
    }

    public static function createForDom(\DOMNode $DOMNode, string $query): static
    {
        return new static(
            "Element not found in DOM with {$query}!",
            $DOMNode->ownerDocument->saveHTML($DOMNode),
        );
    }
}
