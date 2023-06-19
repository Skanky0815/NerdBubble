<?php

declare(strict_types=1);

namespace App\Services\Crawler;

use Illuminate\Support\Collection;

interface Provider
{
    public function loadArticles(): Collection;
}
