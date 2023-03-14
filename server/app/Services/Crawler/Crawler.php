<?php declare(strict_types=1);

namespace App\Services\Crawler;

interface Crawler
{
    public function provider(): string;

    public function crawl(): void;
}
