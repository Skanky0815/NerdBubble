<?php

declare(strict_types=1);

namespace Domains\Article\Repositories;

interface Providers
{
    public function allActiveWithKeywords(): array;
}
