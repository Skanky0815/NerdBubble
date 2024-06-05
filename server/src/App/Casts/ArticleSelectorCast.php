<?php

declare(strict_types=1);

namespace App\Casts;

use Domains\Article\ValueObjects\ArticleSelector;
use Domains\Article\ValueObjects\DateSelector;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class ArticleSelectorCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return new ArticleSelector(
            $attributes['articleSelectorWrapper'],
            $attributes['articleSelectorHeadline'],
            $attributes['articleSelectorSubHeadline'],
            $attributes['articleSelectorDescription'],
            $attributes['articleSelectorImage'],
            new DateSelector(
                $attributes['articleSelectorDate'],
                $attributes['articleSelectorDateFormat'],
                $attributes['articleSelectorDateLocale'],
            ),
            $attributes['articleSelectorLink'],
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (!$value instanceof ArticleSelector) {
            throw new \InvalidArgumentException('The given value is not an ArticleSelector instance.');
        }

        return [
            'articleSelectorWrapper' => $value->wrapper,
            'articleSelectorHeadline' => $value->headline,
            'articleSelectorSubHeadline' => $value->subHeadline,
            'articleSelectorDescription' => $value->description,
            'articleSelectorImage' => $value->image,
            'articleSelectorDate' => $value->dateSelector->date,
            'articleSelectorDateFormat' => $value->dateSelector->format,
            'articleSelectorDateLocale' => $value->dateSelector->locale,
            'articleSelectorLink' => $value->link,
        ];
    }
}
