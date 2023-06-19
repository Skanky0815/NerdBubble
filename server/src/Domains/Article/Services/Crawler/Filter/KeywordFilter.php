<?php

declare(strict_types=1);

namespace Domains\Article\Services\Crawler\Filter;

use Domains\Article\Aggregates\Article;
use Domains\Article\Repositories\Keywords;

class KeywordFilter
{
    public function __construct(
        private readonly Keywords $keywords
    ) {
    }

    public function removeArticlesWhoNotMatchAnyKeyword(array $allArticles): array
    {
        $allKeywords = $this->keywords->all();

        return array_filter(
            $allArticles,
            fn (Article $article): bool => $article->matchWithKeywords(...$allKeywords)
        );
    }
}
