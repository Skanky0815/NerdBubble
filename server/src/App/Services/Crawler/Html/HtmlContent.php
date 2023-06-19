<?php

declare(strict_types=1);

namespace App\Services\Crawler\Html;

use App\Exceptions\MissingImageException;
use App\Exceptions\MissingLinkException;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\Language;

readonly class HtmlContent
{
    public function __construct(
        private \DOMXPath $xpath,
        private \DOMElement $rootElement,
    ) {
    }

    public function text(#[Language('XPath')] string $query): string
    {
        $text = $this->findElement($query)?->textContent ?: '';

        return preg_replace('/\s+/', ' ', trim($text));
    }

    public function image(#[Language('XPath')] ?string $query = './/*/img', string $attribute = 'src'): string
    {
        return $this->findElement($query)?->getAttribute($attribute)
            ?: throw MissingImageException::createForDom($this->rootElement, $query, $attribute);
    }

    public function link(#[Language('XPath')] ?string $query = './/*/a'): string
    {
        return $this->findElement($query)?->getAttribute('href') ?: throw new MissingLinkException();
    }

    public function date(
        #[Language('XPath')] string $query,
        string $format,
        ?string $local = 'en_EN',
        ?string $attribute = null
    ): Carbon {
        $dateElement = $this->findElement($query);

        if (null === $attribute) {
            $dateString = $dateElement?->textContent;
        } else {
            $dateString = $dateElement?->getAttribute($attribute);
        }

        return empty($dateString) ? Carbon::now() : Carbon::createFromLocaleFormat($format, $local, $dateString);
    }

    public function findElement(#[Language('XPath')] string $query): ?\DOMNode
    {
        return $this->xpath->query($query, $this->rootElement)->item(0);
    }
}
