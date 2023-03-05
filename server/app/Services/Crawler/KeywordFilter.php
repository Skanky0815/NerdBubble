<?php

namespace App\Services\Crawler;

use App\Models\Keyword;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

readonly class KeywordFilter
{
    private Collection $allKeywords;

    public function __construct(Keyword $keyword)
    {
        $this->allKeywords = $keyword->all()->map(fn (Keyword $keyword) => $keyword->word);
    }

    public function matchKeyword(string $str): bool
    {
        return Str::contains($str, $this->allKeywords, true);
    }
}
