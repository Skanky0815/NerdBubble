<?php declare(strict_types=1);

namespace App\Mapper;

use App\Models\Article as ArticleEloquentModel;
use Domains\Article\Aggregates\Article;
use Domains\Article\ValueObjects\Products;

class ArticleMapper
{
    public static function fromEloquent(ArticleEloquentModel $articleEloquent): Article
    {
        $products = $articleEloquent->products->map(ProductMapper::fromEloquent(...))->toArray();

        return new Article(
            provider: $articleEloquent->provider,
            headline: $articleEloquent->title,
            publishDate: $articleEloquent->date,
            image: $articleEloquent->image,
            link: $articleEloquent->link,
            products: new Products($products),
            id: $articleEloquent->id,
            subHeadline: $articleEloquent->subTitle,
            description: $articleEloquent->description,
        );
    }

    public static function toEloquent(Article $article): ArticleEloquentModel
    {
        $articleEloquent = new ArticleEloquentModel();
        if ($article->id) {
            $articleEloquent = ArticleEloquentModel::findOrFail($article->id);
        }

        $articleEloquent->title = $article->headline;
        $articleEloquent->subTitle = $article->subHeadline;
        $articleEloquent->description = $article->description;
        $articleEloquent->link = $article->link;
        $articleEloquent->image = $article->image;
        $articleEloquent->date = $article->publishDate;
        $articleEloquent->provider = $article->provider;

        return $articleEloquent;
    }
}
