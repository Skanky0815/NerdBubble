<?php

declare(strict_types=1);

namespace Tests\Feature\Repository;

use App\Mapper\ArticleMapper;
use App\Models\Article;
use App\Models\Product;
use App\Repository\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function findByTitleOrCreateWhenTitleExistsThenFoundArticleReturned(): void
    {
        $article = Article::factory()->create([
            'title' => 'Foo',
        ]);

        $result = $this->repository()->findByTitleOrCreate([
            'title' => 'Foo',
        ]);

        self::assertTrue($article->id->isEquals($result->id));
    }

    #[Test]
    public function addAllWhenTitleNotExistsThenTheNewArticleWillReturned(): void
    {
        $productData = Product::factory()->make();
        $articleData = Article::factory()->make([
            'products' => collect([$productData]),
        ]);
        $article = ArticleMapper::fromEloquent($articleData);

        $this->repository()->addAll($article);

        $this->assertDatabaseHas('articles', [
            'title' => (string) $articleData->title,
            'link' => $articleData->link,
            'image' => $articleData->image,
        ]);
        $this->assertDatabaseHas('products', [
            'name' => $productData->name,
            'link' => $productData->link,
            'image' => $productData->image,
        ]);
    }

    #[Test]
    public function fromTheLastTwoWeeksWhenArticleDateIsInRangeThenTheyWillBeReturned(): void
    {
        Carbon::setTestNow(Carbon::create(2000, 1, 30));
        Article::factory(2)->create(['date' => '2000-01-01']);
        Article::factory(2)->create(['date' => '2000-01-20']);

        $result = $this->repository()->fromTheLastTwoWeeks();

        self::assertCount(2, $result);
        self::assertInstanceOf(\Domains\Article\Aggregates\Article::class, $result[0]);
    }

    private function repository(): ArticleRepository
    {
        return new ArticleRepository();
    }
}
