<?php declare(strict_types=1);

namespace App\Mapper;

use App\Models\Keyword as KeywordEloquentModel;
use Domains\Article\Entities\Keyword;
use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\Word;

class KeywordMapper
{
    public static function fromEloquent(KeywordEloquentModel $keywordEloquent): Keyword
    {
        return new Keyword(
            word: new Word($keywordEloquent->word),
            id: new Id($keywordEloquent->id),
        );
    }
}
