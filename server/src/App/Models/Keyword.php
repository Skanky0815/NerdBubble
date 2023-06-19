<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\IdCast;
use App\Casts\WordCast;
use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\Word;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Keyword.
 *
 * @property Id                              $id
 * @property Word                            $word
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 *
 * @method static \Database\Factories\KeywordFactory            factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Keyword newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Keyword newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Keyword query()
 * @method static \Illuminate\Database\Eloquent\Builder|Keyword whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Keyword whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Keyword whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Keyword whereWord($value)
 *
 * @mixin \Eloquent
 */
class Keyword extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['word'];

    protected $casts = [
        'id' => IdCast::class,
        'word' => WordCast::class,
    ];
}
