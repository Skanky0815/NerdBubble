<?php declare(strict_types=1);

namespace App\Casts;

use Carbon\CarbonImmutable;
use Domains\Article\ValueObjects\PublishDate;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class PublishDateCast implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return new PublishDate(CarbonImmutable::parse($value));
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
