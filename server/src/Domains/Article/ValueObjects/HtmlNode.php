<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Carbon\CarbonImmutable;
use Domains\Article\Exceptions\HtmlParserException;
use JetBrains\PhpStorm\Language;

readonly class HtmlNode
{
    public function __construct(
        private \DOMXPath $xpath,
        private \DOMNode $DOMNode,
    ) {}

    public function text(#[Language('XPath')] string $query): string
    {
        $text = $this->findElement($query)?->textContent ?: '';

        return preg_replace('/\s+/', ' ', trim($text));
    }

    public function image(#[Language('XPath')] ?string $query = './/*/img', string $attribute = 'src'): string
    {
        return $this->findElement($query)?->getAttribute($attribute)
            ?: throw HtmlParserException::createForDom($this->DOMNode, $query, $attribute);
    }

    public function link(#[Language('XPath')] ?string $query = './/*/a'): string
    {
        return $this->findElement($query)?->getAttribute('href')
            ?: throw HtmlParserException::createForDom($this->DOMNode, $query);
    }

    public function date(DateSelector $dateSelector): CarbonImmutable
    {
        $dateElement = $this->findElement($dateSelector->date);

        if (null === $dateSelector->attribute) {
            $dateString = $dateElement?->textContent;
        } else {
            $dateString = $dateElement?->getAttribute($dateSelector->attribute);
        }

        return empty($dateString) ? CarbonImmutable::now()
            : CarbonImmutable::createFromLocaleFormat($dateSelector->format, $dateSelector->locale, trim($dateString));
    }

    public function findElement(#[Language('XPath')] string $query): ?\DOMNode
    {
        return $this->xpath->query($query, $this->DOMNode)->item(0);
    }
}
