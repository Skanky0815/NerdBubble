<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

readonly class DateSelector
{
    public function __construct(
        public string $date,
        public string $format,
        public ?string $locale = 'en_EN',
        public ?string $attribute = null,
    ) {}
}
