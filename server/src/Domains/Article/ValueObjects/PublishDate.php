<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Carbon\CarbonImmutable;

readonly class PublishDate implements \Stringable
{
    public function __construct(
        private CarbonImmutable $value,
    ) {
    }

    public function __toString(): string
    {
        return $this->value->format('Y-m-d');
    }
}
