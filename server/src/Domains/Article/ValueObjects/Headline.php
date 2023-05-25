<?php declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Exceptions\ValueObjectValidateException;
use Stringable;

readonly class Headline implements Stringable
{
    public function __construct(
        private string $value,
    )
    {
        $this->validate();
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function validate(): void
    {
        if (empty($this->value)) {
            throw new ValueObjectValidateException('Headline should not be empty!');
        }
    }
}
