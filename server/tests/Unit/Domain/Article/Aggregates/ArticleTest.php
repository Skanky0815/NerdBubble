<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Article\Aggregates;

use Carbon\CarbonImmutable;
use Domains\Article\Aggregates\Article;
use Domains\Article\Entities\Keyword;
use Domains\Article\ValueObjects\Description;
use Domains\Article\ValueObjects\Headline;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\Products;
use Domains\Article\ValueObjects\Provider;
use Domains\Article\ValueObjects\PublishDate;
use Domains\Article\ValueObjects\SubHeadline;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ArticleTest extends TestCase
{
    #[Test]
    public function matchWithKeywords_when_one_keyword_match_then_true_will_be_returned(): void
    {
        $result = $this->aggregate()->matchWithKeywords(Keyword::fromString('Sub'));

        static::assertTrue($result);
    }

    #[Test]
    public function matchWithKeywords_when_no_keyword_match_then_false_will_be_returned(): void
    {
        $result = $this->aggregate()->matchWithKeywords(Keyword::fromString('Missing'));

        static::assertFalse($result);
    }

    private function aggregate(): Article
    {
        return new Article(
            provider: Provider::ASMODEE,
            headline: new Headline('Headline Text'),
            publishDate: new PublishDate(CarbonImmutable::create(2077)),
            image: new ImageUrl('https://image.png'),
            link: new Link('https://article.link'),
            products: new Products([]),
            subHeadline: new SubHeadline('Sub Headline Text'),
            description: new Description('Some Description Text'),
        );
    }
}
