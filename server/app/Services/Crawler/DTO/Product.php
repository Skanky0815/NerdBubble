<?php declare(strict_types=1);

namespace App\Services\Crawler\DTO;

use App\Services\Crawler\Html\HtmlContent;

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

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'link' => $this->link,
            'image' => $this->image,
        ];
    }
}
