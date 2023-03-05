<?php

namespace App\Services\Crawler\Asmodee\DTO;

use Illuminate\Support\Collection;

readonly class Article
{
    public string $filterText;

    public function __construct(
        public string $headline,
        public string $subHeadline,
        public Collection $products,
        public string $slug,
        public string $creationDate,
        public string $image,
    ) {
        $productFilterText = $this->products->map(fn (Product $product) => $product->name)->join(' ');
        $this->filterText = $this->headline.$this->subHeadline.$productFilterText;
    }

    public static function createFromArray(array $articleData): self
    {
        $filterEmptyProducts = fn (array $content) => false === empty($content['product']);
        $mapToProducts = fn (array $content) => Product::createFromArray($content['product']);

        return new Article(
            $articleData['headline'],
            $articleData['subHeadline'],
            collect($articleData['content'])->filter($filterEmptyProducts)->map($mapToProducts),
            $articleData['slug'],
            $articleData['creationDate'],
            $articleData['tileImage']['formats']['small']['url'],
        );
    }
}
