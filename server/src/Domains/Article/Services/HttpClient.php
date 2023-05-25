<?php declare(strict_types=1);

namespace Domains\Article\Services;

use DOMDocument;

interface HttpClient
{
    public function loadContentFromWebsite(string $url): DOMDocument|array;
}
