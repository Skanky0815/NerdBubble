<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Models\ProviderType;
use App\Services\Crawler\Html\HtmlContent;
use Illuminate\Support\Carbon;

class BlueBrixxArticle extends Article
{
    public static function create(array|HtmlContent $content): Article
    {
        return new self(
            provider: ProviderType::BLUE_BRIXX,
            title: 'BlueBrixx',
            link: 'https://www.bluebrixx.com/de/neuheiten?limit=32',
            date: Carbon::now(),
            image: 'https://www.bluebrixx.com/img/new_design/logo_mitSteinen-min.png',
            products: $content['products'],
        );
    }
}
