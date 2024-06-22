<?php

declare(strict_types=1);

namespace Domains\Article\Aggregates;

use Domains\Article\Entities\Keyword;
use Domains\Article\ValueObjects\Description;
use Domains\Article\ValueObjects\FilterText;
use Domains\Article\ValueObjects\Headline;
use Domains\Article\ValueObjects\Id;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\Products;
use Domains\Article\ValueObjects\ProviderType;
use Domains\Article\ValueObjects\PublishDate;
use Domains\Article\ValueObjects\SubHeadline;

readonly class Article
{
    public function __construct(
        public ProviderType $provider,
        public Headline $headline,
        public PublishDate $publishDate,
        public ImageUrl $image,
        public Link $link,
        public Products $products,
        public ?Id $id = null,
        public ?SubHeadline $subHeadline = null,
        public ?Description $description = null,
    ) {}

    public function matchWithKeywords(Keyword ...$keywords): bool
    {
        foreach ($keywords as $keyword) {
            if ($this->filterText()->matchWithKeyword($keyword)) {
                return true;
            }
        }

        return false;
    }

    private function filterText(): FilterText
    {
        return new FilterText(
            $this->headline,
            $this->subHeadline,
            $this->products->filterText(),
            $this->description,
        );
    }
}
