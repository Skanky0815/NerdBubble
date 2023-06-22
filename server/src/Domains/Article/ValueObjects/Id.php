<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Exceptions\ValueObjectValidateException;

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
        if (1 !== preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $this->value)) {
            throw new ValueObjectValidateException('Id should be a UUID!');
        }
    }
}
