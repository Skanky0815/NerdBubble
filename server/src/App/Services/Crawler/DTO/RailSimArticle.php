<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Models\Provider;
use App\Services\Crawler\Html\HtmlContent;

class RailSimArticle extends Article
{
    public static function create(HtmlContent|array $content): self
    {
        return new self(
            provider: Provider::RAIL_SIM,
            title: $content->text('.//li[@class="columnSubject"]/h3/a'),
            link: $content->link('.//li[@class="columnSubject"]/h3/a'),
            date: $content->date(
                './/li[@class="columnLastPost"]/div/div/small/time',
                DATE_ISO8601_EXPANDED,
                attribute: 'datetime'
            ),
            image: 'https://www.rail-sim.de/wp-content/uploads/2016/04/rail-sim_logo.png',
        );
    }
}
