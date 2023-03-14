<?php declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Services\Crawler\Html\HtmlContent;

class BlueBrixxProduct extends Product
{
    public static function create(HtmlContent|array $content): Product
    {
        return new self(
            name: $content->text('.//div[@class="searchItemTitle"]'),
            link: $content->link(),
            image: $content->image()
        );
    }
}
