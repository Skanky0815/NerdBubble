<?php

declare(strict_types=1);

namespace App\Repository;

use App\Mapper\KeywordMapper;
use App\Models\Keyword as KeywordModel;
use Domains\Article\Entities\Keyword;
use Domains\Article\Repositories\Keywords;
use Domains\Article\ValueObjects\Id;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class KeywordRepository implements Keywords
{
    /**
     * @deprecated
     */
    public function findAll(): Collection
    {
        return KeywordModel::all();
    }

    public function all(): array
    {
        return KeywordModel::all()->map(KeywordMapper::fromEloquent(...))->toArray();
    }

    public function removeById(Id $id): void
    {
        KeywordModel::destroy($id);
    }

    public function add(Keyword $keyword): Keyword
    {
        return DB::transaction(function () use ($keyword) {
            $keywordEloquent = KeywordMapper::toEloquent($keyword);
            $keywordEloquent->save();

            return KeywordMapper::fromEloquent($keywordEloquent);
        });
    }
}
