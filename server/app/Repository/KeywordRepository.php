<?php declare(strict_types=1);

namespace App\Repository;

use App\Models\Keyword;
use Illuminate\Support\Collection;

class KeywordRepository
{
    public function findAll(): Collection
    {
        return Keyword::all();
    }
}
