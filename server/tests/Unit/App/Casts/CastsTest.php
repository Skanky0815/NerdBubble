<?php declare(strict_types=1);

namespace Tests\Unit\App\Casts;

use App\Casts\DescriptionCast;
use App\Casts\HeadlineCast;
use App\Casts\IdCast;
use App\Casts\ImageUrlCast;
use App\Casts\LinkCast;
use App\Casts\ProductNameCast;
use App\Casts\PublishDateCast;
use App\Casts\SubHeadlineCast;
use App\Casts\WordCast;
use App\Models\Article;
use Carbon\CarbonImmutable;
use Domains\Article\ValueObjects\Description;
use Domains\Article\ValueObjects\Headline;
use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\ProductName;
use Domains\Article\ValueObjects\PublishDate;
use Domains\Article\ValueObjects\SubHeadline;
use Domains\Article\ValueObjects\Word;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CastsTest extends TestCase
{
    #[Test]
    #[DataProvider('setDataProvider')]
    public function set_should_return_the_given_value(
        CastsAttributes $cast,
        string $key,
        object $valueObject,
    ): void {
        $result = $cast->set(new Article(), $key, $valueObject, []);

        self::assertSame((string) $valueObject, (string) $result);
    }

    public static function setDataProvider(): array
    {
        return [
            'HeadlineCast' => [new HeadlineCast(), 'headline', new Headline('headline')],
            'ImageUrlCast' => [new ImageUrlCast(), 'imageUrl', new ImageUrl('https://image.png')],
            'LinkCast' => [new LinkCast(), 'link', new Link('https://link.url')],
            'ProductNameCast' => [new ProductNameCast(), 'productName', new ProductName('name produkt')],
            'PublishDateCast' => [new PublishDateCast(), 'publishDate', new PublishDate(CarbonImmutable::create(2042))],
            'WordCast' => [new WordCast(), 'word', new Word('example')],
            'DescriptionCast' => [new DescriptionCast(), 'description', new Description('some description text')],
            'IdCast' => [new IdCast(), 'id', new Id('00cb7fd4-4f83-4520-8bac-07488584402a')],
            'SubHeadlineCast' => [new SubHeadlineCast(), 'subHeadline', new SubHeadline('some text')],
        ];
    }

    #[Test]
    #[DataProvider('getDataProvider')]
    public function get_should_return_the_given_value_as_value_object(
        CastsAttributes $cast,
        string $key,
        string $value,
        string $className
    ): void {
        $result = $cast->get(new Article(), $key, $value, []);

        self::assertInstanceOf($className, $result);
        self::assertSame($value, (string) $result);
    }

    public static function getDataProvider(): array
    {
        return [
            'HeadlineCast' => [new HeadlineCast(), 'headline', 'headline text', Headline::class],
            'ImageUrlCast' => [new ImageUrlCast(), 'imageUrl', 'https://image.png', ImageUrl::class],
            'LinkCast' => [new LinkCast(), 'link', 'https://link.url', Link::class],
            'ProductNameCast' => [new ProductNameCast(), 'productName', 'name produkt', ProductName::class],
            'PublishDateCast' => [new PublishDateCast(), 'publishDate', '2042-01-01', PublishDate::class],
            'WordCast' => [new WordCast(), 'word', 'example', Word::class],
            'DescriptionCast' => [new DescriptionCast(), 'description', 'some description text', Description::class],
            'IdCast' => [new IdCast(), 'id', '00cb7fd4-4f83-4520-8bac-07488584402a', Id::class],
            'SubHeadlineCast' => [new SubHeadlineCast(), 'subHeadline', 'some text', SubHeadline::class],
        ];
    }

    #[Test]
    #[DataProvider('getNullDataProvider')]
    public function get_when_the_given_value_is_null_then_return_null(
        CastsAttributes $cast,
        string $key,
    ): void {
        $result = $cast->get(new Article(), $key, null, []);

        self::assertNull($result);
    }

    public static function getNullDataProvider(): array
    {
        return [
            'DescriptionCast' => [new DescriptionCast(), 'description'],
            'IdCast' => [new IdCast(), 'id'],
            'SubHeadlineCast' => [new SubHeadlineCast(), 'subHeadline'],
        ];
    }
}
