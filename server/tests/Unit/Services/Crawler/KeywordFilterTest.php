<?php declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Keyword;
use App\Repository\KeywordRepository;
use App\Services\Crawler\KeywordFilter;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;

class KeywordFilterTest extends MockeryTestCase
{
    private (KeywordRepository&LegacyMockInterface)|(KeywordRepository&MockInterface) $keywordRepository;

    public function testMatchKeyword_when_keyword_is_in_given_string_then_return_true(): void
    {
        $keyword = new Keyword();
        $keyword->word = 'Test';

        $this->keywordRepository->allows()->findAll()->andReturn(collect([$keyword]));

        $result = $this->service()->matchKeyword('my Test string');

        static::assertTrue($result);
    }

    public function testMatchKeyword_when_keyword_is_not_in_given_string_than_return_false(): void
    {
        $keyword = new Keyword();
        $keyword->word = 'not found';

        $this->keywordRepository->allows()->findAll()->andReturn(collect([$keyword]));

        $result = $this->service()->matchKeyword('my Test string');

        static::assertFalse($result);
    }

    protected function mockeryTestSetUp(): void
    {
        $this->keywordRepository = Mockery::mock(KeywordRepository::class);
    }

    private function service(): KeywordFilter
    {
        return new KeywordFilter(
            $this->keywordRepository,
        );
    }
}
