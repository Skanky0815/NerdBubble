<?php declare(strict_types=1);

namespace Tests\Unit\App\Casts;

use App\Casts\DescriptionCast;
use App\Models\Article;
use Domains\Article\ValueObjects\Description;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DescriptionCastTest extends TestCase
{
    #[Test]
    public function set_should_return_the_given_value(): void
    {
        $descriptionCast = new DescriptionCast();

        $result = $descriptionCast->set(new Article(), 'description', new Description('text'), []);

        self::assertSame('text', (string) $result);
    }

    #[Test]
    public function get_should_return_the_given_value_as_description_value_object(): void
    {
        $descriptionCast = new DescriptionCast();

        $result = $descriptionCast->get(new Article(), 'description', 'text', []);

        self::assertInstanceOf(Description::class, $result);
        self::assertSame('text', (string) $result);
    }

    #[Test]
    public function get_when_the_given_value_is_null_then_return_null(): void
    {
        $descriptionCast = new DescriptionCast();

        $result = $descriptionCast->get(new Article(), 'description', null, []);

        self::assertNull($result);
    }
}
