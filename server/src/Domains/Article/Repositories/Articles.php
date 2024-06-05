<?php

declare(strict_types=1);

namespace Domains\Article\Repositories;

use Domains\Article\Aggregates\Article;
use Domains\Article\ValueObjects\Headline;

interface Articles
{
    public function withTheGivenHeadlineDoNotExist(Headline $headline): bool;

    public function fromTheLastTwoWeeks(): array;

    public function add(Article $article): Article;

    public function addAll(Article ...$articles);
}
