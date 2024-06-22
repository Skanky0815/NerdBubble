<?php

declare(strict_types=1);

namespace Domains\Article\Aggregates;

use Domains\Article\ValueObjects\ArticleSelector;
use Domains\Article\ValueObjects\Id;

readonly class Provider
{
    public function __construct(
        public string $name,
        public string $color,
        public string $logoImage,
        public string $aggregateUrl,
        public bool $hasProducts,
        public string $layout,
        public bool $isActive,
        public ArticleSelector $articleSelector,
        public string $articleHeadline,
        public string $articleImage,
        public string $articleLink,
        public ?Id $id = null,
    ) {}
}
