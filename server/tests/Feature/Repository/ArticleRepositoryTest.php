<?php declare(strict_types=1);

namespace Tests\Feature\Repository;

use App\Models\Article;
use App\Repository\ArticleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testFindByTitleOrCreate_when_title_exists_then_found_article_returned(): void
    {
        $article = Article::factory()->create([
            'title' => 'Foo',
        ]);

        $result = $this->repository()->findByTitleOrCreate([
            'title' => 'Foo',
        ]);

        static::assertSame($article->id, $result->id);
    }

    public function testFindByTitleOrCreate_when_title_not_exists_then_the_new_article_will_returned(): void
    {
        $articleData = Article::factory()->make();

        $result = $this->repository()->findByTitleOrCreate($articleData->toArray());

        $this->assertDatabaseHas('articles', ['id' => $result->id, ...$result->toArray()]);
    }

    private function repository(): ArticleRepository
    {
        return new ArticleRepository();
    }
}
