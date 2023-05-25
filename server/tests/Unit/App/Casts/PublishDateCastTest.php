<?php declare(strict_types=1);

namespace Tests\Unit\App\Casts;

use App\Casts\PublishDateCast;
use App\Models\Article;
use Carbon\CarbonImmutable;
use Domains\Article\ValueObjects\PublishDate;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class PublishDateCastTest extends TestCase
{
    #[Test]
    public function set_should_return_the_given_value(): void
    {
        $publishDateCast = new PublishDateCast();

        $result = $publishDateCast->set(
            new Article(),
            'publishDate',
            new PublishDate(CarbonImmutable::create(1984)),
            []
        );

        self::assertSame('1984-01-01', (string) $result);
    }

    #[Test]
    public function get_should_return_the_given_value_as_publishDate_value_object(): void
    {
        $publishDateCast = new PublishDateCast();

        $result = $publishDateCast->get(new Article(), 'publishDate', '1984-01-01', []);

        self::assertInstanceOf(PublishDate::class, $result);
        self::assertSame('1984-01-01', (string) $result);
    }
}
