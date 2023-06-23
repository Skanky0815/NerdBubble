<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Exceptions\ValueObjectValidateException;

readonly class Link implements \Stringable
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

    private function validate(): void
    {
        if (empty($this->value)) {
            throw new ValueObjectValidateException('Link should not be empty!');
        }

        foreach (['http://', 'https://'] as $needed) {
            if (false === str_starts_with($this->value, $needed)) {
                throw new ValueObjectValidateException('Link should start with http:// or https://');
            }
        }
    }
}
