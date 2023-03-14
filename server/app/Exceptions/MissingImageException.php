<?php declare(strict_types=1);

namespace App\Exceptions;

use DOMElement;

class MissingImageException extends CrawlerException
{
    private function __construct(string $msg, public readonly string $root)
    {
        parent::__construct($msg);
    }

    public static function createForDom(DOMElement $rootElement, string $query, string $attribute): self
    {
        return new static(
            "No image found for $attribute in $query!",
            $rootElement->ownerDocument->saveHTML($rootElement),
        );
    }

    public static function createForArray(array $content): self
    {
        return new static(
            "No image in array found!",
            json_encode($content),
        );
    }
}
