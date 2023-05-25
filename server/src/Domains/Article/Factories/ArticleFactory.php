<?php declare(strict_types=1);

namespace Domains\Article\Factories;

use Carbon\CarbonImmutable;
use Domains\Article\Aggregates\Article;
use Domains\Article\ValueObjects\Description;
use Domains\Article\ValueObjects\Headline;
use Domains\Article\ValueObjects\ImageUrl;
use Domains\Article\ValueObjects\Link;
use Domains\Article\ValueObjects\Products;
use Domains\Article\ValueObjects\Provider;
use Domains\Article\ValueObjects\PublishDate;
use Domains\Article\ValueObjects\SubHeadline;

class ArticleFactory
{
    private Provider $provider;
    private Headline $headline;
    private PublishDate $publishDate;
    private ImageUrl $image;
    private Link $link;
    private ?Products $products = null;
    private ?SubHeadline $subHeadline = null;
    private ?Description $description = null;

    public function setArticleData(
        Provider $provider,
        string $headline,
        CarbonImmutable $publishDate,
        string  $image,
        string $link,
        ?string $subHeadline = null,
        ?string $description = null,
    ): self {
        $this->provider = $provider;
        $this->headline = new Headline($headline);
        $this->publishDate = new PublishDate($publishDate);
        $this->image = new ImageUrl($image);
        $this->link = new Link($link);

        if (null !== $subHeadline) {
            $this->subHeadline = new SubHeadline($subHeadline);
        }

        if (null !== $description) {
            $this->description = new Description($description);
        }

        return $this;
    }

    public function setProducts(array $products): self
    {
        $this->products = new Products($products);

        return $this;
    }

    public function build(): Article
    {
        return new Article(
            provider: $this->provider,
            headline: $this->headline,
            publishDate: $this->publishDate,
            image: $this->image,
            link: $this->link,
            products: $this->products ?? new Products([]),
            subHeadline: $this->subHeadline,
            description: $this->description,
        );
    }
}
