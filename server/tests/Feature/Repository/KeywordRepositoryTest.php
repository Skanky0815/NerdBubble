<?php declare(strict_types=1);

namespace Tests\Feature\Repository;

use App\Models\Keyword;
use App\Repository\KeywordRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KeywordRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testAll_should_return_all_keywords(): void
    {
        Keyword::factory(2)->create();

        $result = $this->repository()->findAll();

        static::assertCount(2, $result);
    }

    private function repository(): KeywordRepository
    {
        return new KeywordRepository();
    }
}
