<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Models\Provider as ProviderEloquentModel;
use Domains\Article\Aggregates\Provider;

class ProviderMapper
{
    public static function fromEloquent(ProviderEloquentModel $providerEloquent): Provider
    {
        return new Provider(
            name: $providerEloquent->name,
            color: $providerEloquent->color,
            logoImage: $providerEloquent->logoImage,
            aggregateUrl: $providerEloquent->aggregateUrl,
            hasProducts: $providerEloquent->hasProducts,
            layout: $providerEloquent->layout,
            isActive: $providerEloquent->isActive,
            articleSelector: $providerEloquent->articleSelector,
            articleHeadline: $providerEloquent->articleHeadline,
            articleImage: $providerEloquent->articleImage,
            articleLink: $providerEloquent->articleLink,
            id: $providerEloquent->id,
        );
    }
}
