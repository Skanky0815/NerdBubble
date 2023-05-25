<?php declare(strict_types=1);

namespace App\Casts;

use Domains\Article\ValueObjects\Link;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class LinkCast implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return new Link($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
