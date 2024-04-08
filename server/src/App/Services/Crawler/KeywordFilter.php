<?php

declare(strict_types=1);

namespace App\Services\Crawler;

use App\Models\Keyword;
use App\Repository\KeywordRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class KeywordFilter
{
    private ?Collection $allKeywords = null;

    public function __construct(
        private readonly KeywordRepository $keywordRepository
    ) {}

    public function matchKeyword(string $str): bool
    {
        return Str::contains($str, $this->allKeywords(), true);
    }

    private function allKeywords(): Collection
    {
        if (null === $this->allKeywords) {
            $mapToString = fn (Keyword $keyword): string => (string) $keyword->word;

            $this->allKeywords = $this->keywordRepository->findAll()->map($mapToString);
        }

        return $this->allKeywords;
    }
}
