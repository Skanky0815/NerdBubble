<?php declare(strict_types=1);

namespace App\Casts;

use Domains\Article\ValueObjects\Id;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class IdCast implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return null === $value ? null : new Id($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
