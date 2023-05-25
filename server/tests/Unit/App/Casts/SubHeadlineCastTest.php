<?php declare(strict_types=1);

namespace Tests\Unit\App\Casts;

use App\Casts\SubHeadlineCast;
use App\Models\Article;
use Domains\Article\ValueObjects\SubHeadline;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SubHeadlineCastTest extends TestCase
{
    #[Test]
    public function set_should_return_the_given_value(): void
    {
        $subHeadlineCast = new SubHeadlineCast();

        $result = $subHeadlineCast->set(new Article(), 'subHeadline', new SubHeadline('text'), []);

        self::assertSame('text', (string) $result);
    }

    #[Test]
    public function get_should_return_the_given_value_as_subHeadline_value_object(): void
    {
        $subHeadlineCast = new SubHeadlineCast();

        $result = $subHeadlineCast->get(new Article(), 'subHeadline', 'text', []);

        self::assertInstanceOf(SubHeadline::class, $result);
        self::assertSame('text', (string) $result);
    }

    #[Test]
    public function get_when_the_given_value_is_null_then_return_null(): void
    {
        $subHeadlineCast = new SubHeadlineCast();

        $result = $subHeadlineCast->get(new Article(), 'subHeadline', null, []);

        self::assertNull($result);
    }
}
