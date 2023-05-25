<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use Domains\Article\Aggregates\Article;
use Domains\Article\Repositories\Articles;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleController extends Controller
{
    public function __construct(
        private readonly Articles $allArticles,
    ) {
    }

    public function __invoke(Request $request): ResourceCollection
    {
        $allArticles = collect($this->allArticles->fromTheLastTwoWeeks())
            ->shuffle()
            ->sortByDesc(fn (Article $article): string => (string)$article->publishDate);

        return ArticleResource::collection($allArticles);
    }
}
