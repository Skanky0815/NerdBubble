<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

readonly class SubHeadline implements \Stringable
{
    public function __construct(
        private string $value,
    ) {
    }

    public function __toString()
    {
        return $this->value;
    }
}
