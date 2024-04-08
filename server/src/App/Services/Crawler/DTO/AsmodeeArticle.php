<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Models\Provider;
use App\Services\Crawler\Html\HtmlContent;
use Illuminate\Support\Carbon;

class AsmodeeArticle extends Article
{
    public static function create(array|HtmlContent $content): self
    {
        $filterEmptyProducts = fn (array $productContent): bool => false === empty($productContent['product']);
        $mapToProducts = fn (array $productContent): Product => AsmodeeProduct::create($productContent['product']);

        return new self(
            provider: Provider::ASMODEE,
            title: $content['headline'],
            link: 'https://www.asmodee.de/news/'.$content['slug'],
            date: Carbon::parse($content['creationDate']),
            image: $content['tileImage']['formats']['small']['url'] ?? '-',
            subTitle: $content['subHeadline'],
            products: collect($content['content'] ?? [])->filter($filterEmptyProducts)->map($mapToProducts),
        );
    }
}
