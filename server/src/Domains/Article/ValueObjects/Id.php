<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Exceptions\ValueObjectValidateException;
use Illuminate\Support\Str;

readonly class Id implements \Stringable
{
    public function __construct(
        private string $value
    ) {
        $this->validate();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function isEquals(self $id): bool
    {
        return $this->value === $id->__toString();
    }

    private function validate(): void
    {
        if (false === Str::isUuid($this->value)) {
            throw new ValueObjectValidateException('Id should be a UUID!');
        }
    }
}
