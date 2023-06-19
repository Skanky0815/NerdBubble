<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Models\Provider;
use App\Services\Crawler\Html\HtmlContent;
use Illuminate\Support\Carbon;

class FShopArticle extends Article
{
    public static function create(HtmlContent|array $content): Article
    {
        return new static(
            provider: Provider::F_SHOP,
            title: 'F-Shop',
            link: 'https://www.f-shop.de/neuheiten/',
            date: Carbon::now(),
            image: 'https://www.f-shop.de/media/image/37/53/7c/logo_website_F_Shop_2.png',
            products: $content['products'],
        );
    }
}
