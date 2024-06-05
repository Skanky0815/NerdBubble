<?php

declare(strict_types=1);

namespace App\Exceptions;

class MissingLinkException extends CrawlerException
{
    private function __construct(string $msg, public readonly string $root)
    {
        parent::__construct($msg);
    }

    public static function createForDom(\DOMElement $rootElement, string $query): static
    {
        return new static(
            "No image found for href in {$query}!",
            $rootElement->ownerDocument->saveHTML($rootElement),
        );
    }
}
