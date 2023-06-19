<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Exceptions\MissingImageException;
use App\Models\Provider;
use App\Services\Crawler\Html\HtmlContent;
use Illuminate\Support\Carbon;

class TswArticle extends Article
{
    public static function create(HtmlContent|array $content): self
    {
        $selectImage = fn (array $img) => $img['thumbSqr']
            ?: $img['thumbWide']
                ?: $img['ghostFeatured']
                    ?: throw MissingImageException::createForArray($content);

        return new self(
            provider: Provider::TSW,
            title: $content['title'],
            link: 'https://live.dovetailgames.com/live/train-sim-world/articles/article/'.$content['slug'],
            date: Carbon::parse($content['date']),
            image: $selectImage($content['images']),
            description: $content['excerpt'],
        );
    }
}
