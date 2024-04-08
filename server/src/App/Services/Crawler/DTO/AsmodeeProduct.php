<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Services\Crawler\Html\HtmlContent;

class AsmodeeProduct extends Product
{
    public static function create(array|HtmlContent $content): Product
    {
        return new self(
            $content['name'],
            'https://www.asmodee.de/produkte/'.$content['slug'],
            $content['facets']['image']
                ?? $content['images']['3dboxl']['url']
                ?? $content['images']['cover']['url']
                ?? dd($content),
        );
    }
}
