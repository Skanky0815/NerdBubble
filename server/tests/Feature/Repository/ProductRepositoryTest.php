<?php

declare(strict_types=1);

namespace Tests\Feature\Repository;

use App\Models\Article;
use App\Models\Product;
use App\Repository\ProductRepository;
use Domains\Article\ValueObjects\ProductName;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function findByNameOrCreateWhenProductNameExistsThenFoundProductReturned(): void
    {
        $article = Article::factory()->create();
        $product = Product::factory()->create([
            'name' => 'foo',
            'article_id' => $article->id,
        ]);

        $result = $this->repository()->findByNameOrCreate([
            'name' => 'foo',
            'image' => 'foo.jpg',
            'link' => 'foo.to',
        ], $article);

        self::assertTrue($product->id->isEquals($result->id));
    }

    #[Test]
    public function findByNameOrCreateWhenProductNameIsNewThenANewProductWillSaved(): void
    {
        $article = Article::factory()->create();

        $result = $this->repository()->findByNameOrCreate([
            'name' => 'foo',
            'image' => 'foo.jpg',
            'link' => 'foo.to',
        ], $article);

        $this->assertDatabaseHas('products', [
            'id' => $result->id,
            'name' => 'foo',
            'image' => 'foo.jpg',
            'link' => 'foo.to',
            'article_id' => $article->id,
        ]);
    }

    #[Test]
    public function withTheGivenNameDoNotExistWhenNameExistsThenFalseWillBeReturned(): void
    {
        Product::factory()->create([
            'name' => 'foo',
        ]);

        $result = $this->repository()->withTheGivenNameDoNotExist(new ProductName('foo'));

        self::assertFalse($result);
    }

    #[Test]
    public function withTheGivenNameDoNotExistWhenNameNotExistsThenTrueWillBeReturned(): void
    {
        $result = $this->repository()->withTheGivenNameDoNotExist(new ProductName('foo'));

        self::assertTrue($result);
    }

    private function repository(): ProductRepository
    {
        return new ProductRepository();
    }
}
