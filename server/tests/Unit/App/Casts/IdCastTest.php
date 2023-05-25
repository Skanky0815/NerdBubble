<?php declare(strict_types=1);

namespace Tests\Unit\App\Casts;

use App\Casts\IdCast;
use App\Models\Article;
use Domains\Article\ValueObjects\Id;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class IdCastTest extends TestCase
{
    #[Test]
    public function set_should_return_the_given_value(): void
    {
        $idCast = new IdCast();

        $result = $idCast->set(new Article(), 'description', new Id('79e3a25a-ec1d-4395-8d2e-ec40747919de'), []);

        self::assertSame('79e3a25a-ec1d-4395-8d2e-ec40747919de', (string) $result);
    }

    #[Test]
    public function get_should_return_the_given_value_as_idCast_value_object(): void
    {
        $idCast = new IdCast();

        $result = $idCast->get(new Article(), 'id', '79e3a25a-ec1d-4395-8d2e-ec40747919de', []);

        self::assertInstanceOf(Id::class, $result);
        self::assertSame('79e3a25a-ec1d-4395-8d2e-ec40747919de', (string) $result);
    }

    #[Test]
    public function get_when_the_given_value_is_null_then_return_null(): void
    {
        $idCast = new IdCast();

        $result = $idCast->get(new Article(), 'id', null, []);

        self::assertNull($result);
    }
}
