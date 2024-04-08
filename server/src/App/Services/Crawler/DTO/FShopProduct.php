<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Services\Crawler\Html\HtmlContent;

class FShopProduct extends Product
{
    public static function create(array|HtmlContent $content): Product
    {
        return new static(
            name: $content->text('.//a[@class="product--title"]'),
            link: $content->link(),
            image: $content->image('.//span[@class="image--media"]/img', 'srcset'),
        );
    }
}
