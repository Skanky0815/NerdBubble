<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Exceptions\ValueObjectValidateException;
use Illuminate\Support\Str;

readonly class ImageUrl implements \Stringable
{
    public function __construct(
        private string $value,
    ) {
        $this->validate();
    }

    public function __toString()
    {
        return $this->value;
    }

    private function validate(): void
    {
        if (empty($this->value)) {
            throw new ValueObjectValidateException('ImageUrl should not be empty!');
        }

        if (false === Str::startsWith($this->value, ['http://', 'https://'])) {
            throw new ValueObjectValidateException("ImageUrl '{$this->value}' should start with http:// or https://");
        }
    }
}
