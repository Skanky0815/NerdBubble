<?php declare(strict_types=1);

namespace Tests\Unit\App\Casts;

use App\Casts\WordCast;
use App\Models\Article;
use Domains\Article\ValueObjects\Word;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class WordCastTest extends TestCase
{
    #[Test]
    public function set_should_return_the_given_value(): void
    {
        $wordCast = new WordCast();

        $result = $wordCast->set(new Article(), 'word', new Word('text'), []);

        self::assertSame('text', (string) $result);
    }

    #[Test]
    public function get_should_return_the_given_value_as_word_value_object(): void
    {
        $wordCast = new WordCast();

        $result = $wordCast->get(new Article(), 'word', 'text', []);

        self::assertInstanceOf(Word::class, $result);
        self::assertSame('text', (string) $result);
    }
}
