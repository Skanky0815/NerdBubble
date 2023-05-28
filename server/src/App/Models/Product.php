<?php declare(strict_types=1);

namespace App\Models;

use App\Casts\IdCast;
use App\Casts\ImageUrlCast;
use App\Casts\LinkCast;
use App\Casts\ProductNameCast;
use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\ProductName;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property Id $id
 * @property string $article_id
 * @property ProductName $name
 * @property Link $link
 * @property ImageUrl $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['article_id', 'name', 'link', 'image'];

    protected $casts = [
        'id' => IdCast::class,
        'name' => ProductNameCast::class,
        'link' => LinkCast::class,
        'image' => ImageUrlCast::class,
    ];
}