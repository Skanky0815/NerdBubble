<?php declare(strict_types=1);

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
}
