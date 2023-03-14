<?php declare(strict_types=1);

namespace App\Repository;

use App\Models\Article;

class ArticleRepository
{
    public function findByTitleOrCreate(array $articleData): Article
    {
        return Article::firstOrCreate(['title' => $articleData['title']], $articleData);
    }
}
