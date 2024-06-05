<?php

declare(strict_types=1);

namespace App\Models;

enum ArticleLayout: string
{
    case IMG_RIGHT = 'IMG_RIGHT';
    case IMG_FULL = 'IMG_FULL';
    case PRODUCTS = 'PRODUCTS';

    public static function getAllValues(): array
    {
        return array_column(ArticleLayout::cases(), 'value');
    }
}
