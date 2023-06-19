<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Exceptions\ValueObjectValidateException;

readonly class Word implements \Stringable
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = strtolower($value);

        $this->validate();
    }

    public function __toString()
    {
        return $this->value;
    }

    private function validate(): void
    {
        if (empty($this->value)) {
            throw new ValueObjectValidateException('Word should not be empty!');
        }
    }
}
