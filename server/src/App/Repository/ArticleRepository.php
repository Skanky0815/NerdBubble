<?php

declare(strict_types=1);

namespace App\Repository;

use App\Mapper\ArticleMapper;
use App\Mapper\ProductMapper;
use App\Models\Article as ArticleEloquentModel;
use Domains\Article\Aggregates\Article;
use Domains\Article\Repositories\Articles;
use Domains\Article\ValueObjects\Headline;
use Domains\Article\ValueObjects\Products;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements Articles
{
    public function findByTitleOrCreate(array $articleData): ArticleEloquentModel
    {
        return ArticleEloquentModel::firstOrCreate(['title' => $articleData['title']], $articleData);
    }

    public function fromTheLastTwoWeeks(): array
    {
        return ArticleEloquentModel::where('date', '>=', Carbon::now()->subDays(14))
            ->with('products')
            ->orderByDesc('date')
            ->get()
            ->map(ArticleMapper::fromEloquent(...))
            ->toArray()
        ;
    }

    public function addAll(Article ...$articles): void
    {
        foreach ($articles as $article) {
            $this->add($article);
        }
    }

    public function add(Article $article): Article
    {
        return DB::transaction(function () use ($article) {
            $articleEloquent = ArticleMapper::toEloquent($article);
            $articleEloquent->save();

            $this->saveProduct($articleEloquent, $article->products);

            return ArticleMapper::fromEloquent($articleEloquent);
        });
    }

    public function withTheGivenHeadlineDoNotExist(Headline $headline): bool
    {
        return false === ArticleEloquentModel::where(['title' => (string) $headline])->exists();
    }

    private function saveProduct(ArticleEloquentModel $articleEloquent, Products $products): void
    {
        foreach ($products as $product) {
            $productEloquent = ProductMapper::toEloquent($product);
            $productEloquent->article_id = $articleEloquent->id;
            $productEloquent->save();
        }
    }
}
