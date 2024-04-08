<?php

declare(strict_types=1);

namespace Domains\Article\Entities;

use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\Word;

readonly class Keyword
{
    public function __construct(
        public Word $word,
        public ?Id $id = null,
    ) {}

    public static function fromString(string $word): static
    {
        return new self(
            new Word($word),
        );
    }
}
