<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

use Domains\Article\Exceptions\ValueObjectValidateException;

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

        foreach (['http://', 'https://'] as $needed) {
            if (false === str_starts_with($this->value, $needed)) {
                throw new ValueObjectValidateException(
                    "ImageUrl '{$this->value}' should start with http:// or https://"
                );
            }
        }
    }
}
