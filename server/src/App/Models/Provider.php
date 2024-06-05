<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\ArticleSelectorCast;
use Domains\Article\ValueObjects\ArticleSelector;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Provider.
 *
 * @property string      $id
 * @property string      $name
 * @property string      $color
 * @property string      $logoImage
 * @property string      $aggregateUrl
 * @property bool        $hasProducts
 * @property string      $layout
 * @property bool        $isActive
 * @property string      $articleSelectorWrapper
 * @property null|string $articleSelectorHeadline
 * @property null|string $articleHeadline
 * @property null|string $articleSelectorSubHeadline
 * @property null|string $articleSelectorDescription
 * @property null|string $articleSelectorImage
 * @property string      $articleSelectorDate
 * @property string      $articleSelectorDateFormat
 * @property string      $articleSelectorDateLocale
 * @property null|string $articleImage
 * @property null|string $articleSelectorLink
 * @property null|string $articleLink
 * @property null|string $productSelectorWrapper
 * @property null|string $productSelectorName
 * @property null|string $productSelectorImage
 * @property null|string $productSelectorLink
 * @property null|Carbon $created_at
 * @property null|Carbon $updated_at
 *
 * @method static \Database\Factories\ProviderFactory            factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereAggregateUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorDateFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorDateLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorSubHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereArticleSelectorWrapper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereHasProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereLogoImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProductSelectorImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProductSelectorLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProductSelectorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereProductSelectorWrapper($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereUpdatedAt($value)
 *
 * @property ArticleSelector $articleSelector
 *
 * @mixin \Eloquent
 */
class Provider extends Model
{
    use HasFactory;
    use HasUuids;

    protected $casts = [
        'hasProducts' => 'boolean',
        'isActive' => 'boolean',
        'articleSelector' => ArticleSelectorCast::class,
    ];

    protected $fillable = [
        'name',
        'color',
        'logoImage',
        'aggregateUrl',
        'hasProducts',
        'layout',
        'isActive',
        'articleSelectorWrapper',
        'articleSelectorHeadline',
        'articleHeadline',
        'articleSelectorSubHeadline',
        'articleSelectorDescription',
        'articleSelectorImage',
        'articleImage',
        'articleSelectorDate',
        'articleSelectorDateFormat',
        'articleSelectorDateLocale',
        'articleSelectorLink',
        'articleLink',
        'productSelectorWrapper',
        'productSelectorName',
        'productSelectorImage',
        'productSelectorLink',
    ];
}
