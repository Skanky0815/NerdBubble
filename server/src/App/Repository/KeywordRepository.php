<?php declare(strict_types=1);

namespace App\Repository;

use App\Mapper\KeywordMapper;
use App\Models\Keyword;
use Domains\Article\Repositories\Keywords;
use Illuminate\Support\Collection;

class KeywordRepository implements Keywords
{
    /**
     * @deprecated
     */
    public function findAll(): Collection
    {
        return Keyword::all();
    }

    public function all(): array
    {
        return Keyword::all()->map(KeywordMapper::fromEloquent(...))->toArray();
    }
}
