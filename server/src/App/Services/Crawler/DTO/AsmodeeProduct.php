<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Services\Crawler\Html\HtmlContent;

class AsmodeeProduct extends Product
{
    public static function create(HtmlContent|array $content): Product
    {
        return new self(
            $content['name'],
            'https://www.asmodee.de/produkte/'.$content['slug'],
            $content['facets']['image'],
        );
    }
}
