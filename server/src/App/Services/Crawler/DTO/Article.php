<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Models\ProviderType;
use App\Services\Crawler\Html\HtmlContent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

abstract class Article
{
    public readonly string $filterText;

    protected function __construct(
        private readonly ProviderType $provider,
        private readonly string       $title,
        private readonly string       $link,
        private readonly Carbon       $date,
        private readonly string       $image,
        private readonly ?string      $subTitle = null,
        private readonly ?string      $description = null,
        private readonly Collection   $products = new Collection(),
    ) {
        $mapToString = fn (Product $product): string => $product->filterText;

        $productFilterText = $this->products->map($mapToString)->join(' ');
        $this->filterText = $this->title.$this->subTitle.$productFilterText.$this->description;
    }

    abstract public static function create(array|HtmlContent $content): self;

    public function products(): Collection
    {
        return $this->products;
    }

    public function toArray(): array
    {
        return [
            'provider' => $this->provider,
            'title' => $this->title,
            'subTitle' => $this->subTitle,
            'description' => $this->description,
            'link' => $this->link,
            'image' => $this->image,
            'date' => $this->date,
        ];
    }
}
