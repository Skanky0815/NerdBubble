<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Models\ProviderType;
use App\Services\Crawler\Html\HtmlContent;

class UlissesSpieleArticle extends Article
{
    public static function create(array|HtmlContent $content): self
    {
        return new self(
            provider: ProviderType::ULISSES_SPIELE,
            title: $content->text('.//*[contains(@class, "entry-title")]'),
            link: $content->link(),
            date: $content->date('.//*[contains(@class, "entry-meta-date")]', 'd. M Y', 'de'),
            image: $content->image(),
            description: $content->text('.//*[contains(@class, "entry-content")]/p'),
        );
    }
}
