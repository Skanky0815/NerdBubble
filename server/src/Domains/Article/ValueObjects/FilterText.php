<?php declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Entities\Keyword;
use Stringable;

readonly class FilterText implements Stringable
{
    private string $value;

    public function __construct(
        Stringable|string|null ...$values,
    ) {
        $this->value = strtolower(implode(' ', $values));
    }

    public function __toString()
    {
        return $this->value;
    }

    public function matchWithKeyword(Keyword $keyword): bool
    {
        return str_contains($this->value, (string)$keyword->word);
    }
}
