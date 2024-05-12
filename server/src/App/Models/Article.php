<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\DescriptionCast;
use App\Casts\HeadlineCast;
use App\Casts\IdCast;
use App\Casts\ImageUrlCast;
use App\Casts\LinkCast;
use App\Casts\PublishDateCast;
use App\Casts\SubHeadlineCast;
use Domains\Article\ValueObjects\Headline;
use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\Provider;
use Domains\Article\ValueObjects\PublishDate;
use Domains\Article\ValueObjects\SubHeadline;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Article.
 *
 * @property Id                                                                 $id
 * @property Headline                                                           $title
 * @property null|SubHeadline                                                   $subTitle
 * @property null|string                                                        $description
 * @property ProviderType                                                           $provider
 * @property Link                                                               $link
 * @property PublishDate                                                        $date
 * @property ImageUrl                                                           $image
 * @property null|Carbon                                                        $created_at
 * @property null|Carbon                                                        $updated_at
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property null|int                                                           $products_count
 *
 * @method static \Database\Factories\ArticleFactory            factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereUpdatedAt($value)
 *
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 *
 * @mixin \Eloquent
 */
class Article extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['title', 'subTitle', 'date', 'link', 'image', 'provider', 'description'];

    protected $casts = [
        'id' => IdCast::class,
        'title' => HeadlineCast::class,
        'subTitle' => SubHeadlineCast::class,
        'provider' => Provider::class,
        'date' => PublishDateCast::class,
        'link' => LinkCast::class,
        'image' => ImageUrlCast::class,
        'description' => DescriptionCast::class,
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
