<?php

declare(strict_types=1);

namespace Domains\Article\Services;

interface HttpClient
{
    public function loadContentFromWebsite(string $url): array|\DOMDocument;
}
