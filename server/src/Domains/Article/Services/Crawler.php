<?php

declare(strict_types=1);

namespace Domains\Article\Services;

interface Crawler
{
    public function provider(): string;

    public function crawl(): void;
}
