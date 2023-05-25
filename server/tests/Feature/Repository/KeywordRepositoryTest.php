<?php declare(strict_types=1);

namespace Tests\Feature\Repository;

use App\Models\Keyword;
use App\Repository\KeywordRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class KeywordRepositoryTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function all_should_return_all_keywords(): void
    {
        Keyword::factory(2)->create();

        $result = $this->repository()->findAll();

        self::assertCount(2, $result);
    }

    private function repository(): KeywordRepository
    {
        return new KeywordRepository();
    }
}
