<?php

declare(strict_types=1);

namespace Tests\Fixtures\Domains\Article\Entities;

use Carbon\CarbonImmutable;
use Domains\Article\Aggregates\Article;
use Domains\Article\ValueObjects\Description;
use Domains\Article\ValueObjects\Headline;
use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\Products;
use Domains\Article\ValueObjects\Provider;
use Domains\Article\ValueObjects\PublishDate;
use Domains\Article\ValueObjects\SubHeadline;

trait ArticleFixture
{
    private function createArticle(): Article
    {
        $faker = fake();

        return new Article(
            provider: Provider::from($faker->randomElement(Provider::getAllValues())),
            headline: new Headline($faker->company),
            publishDate: new PublishDate(CarbonImmutable::now()),
            image: new ImageUrl($faker->imageUrl),
            link: new Link($faker->url),
            products: new Products([]),
            id: new Id($faker->uuid),
            subHeadline: $faker->boolean ? new SubHeadline($faker->paragraph) : null,
            description: $faker->boolean ? new Description($faker->paragraph) : null,
        );
    }
}
