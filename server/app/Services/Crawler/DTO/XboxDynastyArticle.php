<?php declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Models\Provider;
use App\Services\Crawler\Html\HtmlContent;
use Illuminate\Support\Str;

class XboxDynastyArticle extends Article
{
    public static function create(HtmlContent|array $content): self
    {
        $title = $content->text('.//div/div/header/h1/a');
        $title = Str::replace('Xbox Game Pass: ', '', $title);

        return new self(
            provider: Provider::XBOX_DYNASTY,
            title: $title,
            link: $content->link('.//div/div/header/h1/a'),
            date: $content->date('.//div/div/header/div/time', 'd. M Y', 'de_DE'),
            image: $content->image('.//div/a/img'),
            subTitle: $content->text('.//div/div/div[@class="entry-content"]'),
        );
    }
}
