<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Carbon;

class ArticleController extends Controller
{
    public function __invoke(Request $request): ResourceCollection
    {
        $allArticles = Article::where('date', '>=', Carbon::now()->subDays(12))
            ->get()
            ->shuffle()
            ->sortByDesc('date');

        return ArticleResource::collection($allArticles);
    }
}
