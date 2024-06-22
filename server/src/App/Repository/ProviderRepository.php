<?php

declare(strict_types=1);

namespace App\Repository;

use App\Mapper\ProviderMapper;
use App\Models\Provider;
use Domains\Article\Repositories\Providers;

class ProviderRepository implements Providers
{
    public function allActiveWithKeywords(): array
    {
        return Provider::where(['isActive' => true])
            ->get()
            ->map(ProviderMapper::fromEloquent(...))
            ->toArray()
        ;
    }
}
