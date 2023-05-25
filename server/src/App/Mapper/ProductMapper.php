<?php declare(strict_types=1);

namespace App\Mapper;

use App\Models\Product as ProductEloquentModel;
use Domains\Article\Entities\Product;

class ProductMapper
{
    public static function toEloquent(Product $product): ProductEloquentModel
    {
        $productEloquent = new ProductEloquentModel();
        if ($product->id) {
            $productEloquent = ProductEloquentModel::firstOrFail($product->id);
        }

        $productEloquent->name = $product->name;
        $productEloquent->link = $product->link;
        $productEloquent->image = $product->image;

        return $productEloquent;
    }

    public static function fromEloquent(ProductEloquentModel $productEloquent): Product
    {
        return new Product(
            name: $productEloquent->name,
            link: $productEloquent->link,
            image: $productEloquent->image,
            id: $productEloquent->id,
        );
    }
}
