<?php

declare(strict_types=1);

namespace Domains\Article\ValueObjects;

readonly class ArticleSelector
{
    public function __construct(
        public string $wrapper,
        public ?string $headline,
        public ?string $image,
        public DateSelector $dateSelector,
        public ?string $link,
        public ?string $subHeadline = null,
        public ?string $description = null,
    ) {}

    public function hasSubHeadlineSelector(): bool
    {
        return null !== $this->subHeadline;
    }

    public function hasDescriptionSelector(): bool
    {
        return null !== $this->description;
    }
}
