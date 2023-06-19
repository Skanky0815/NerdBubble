<?php

declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Services\Crawler\Html\HtmlContent;
use Domains\Article\ValueObjects\ProductName;

abstract class Product
{
    public readonly string $filterText;

    public function __construct(
        private readonly string $name,
        private readonly string $link,
        private readonly string $image,
    ) {
        $this->filterText = $this->name;
    }

    abstract public static function create(HtmlContent|array $content): self;

    public function getName(): ProductName
    {
        return new ProductName($this->name);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'link' => $this->link,
            'image' => $this->image,
        ];
    }
}
