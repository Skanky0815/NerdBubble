<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Models\Keyword as KeywordEloquentModel;
use Domains\Article\Entities\Keyword;

class KeywordMapper
{
    public static function fromEloquent(KeywordEloquentModel $keywordEloquent): Keyword
    {
        return new Keyword(
            word: $keywordEloquent->word,
            id: $keywordEloquent->id,
        );
    }

    public static function toEloquent(Keyword $keyword): KeywordEloquentModel
    {
        $keywordEloquent = new KeywordEloquentModel();
        if ($keyword->id) {
            $keywordEloquent = KeywordEloquentModel::findOrFail($keyword->id);
        }

        $keywordEloquent->word = $keyword->word;

        return $keywordEloquent;
    }
}
