<?php

declare(strict_types=1);

namespace Tests\Unit\Services\Crawler;

use App\Models\Keyword;
use App\Repository\KeywordRepository;
use App\Services\Crawler\KeywordFilter;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;

/**
 * @internal
 *
 * @coversNothing
 */
class KeywordFilterTest extends MockeryTestCase
{
    private (KeywordRepository&LegacyMockInterface)|(KeywordRepository&MockInterface) $keywordRepository;

    public function testMatchKeywordWhenKeywordIsInGivenStringThenReturnTrue(): void
    {
        $keyword = new Keyword();
        $keyword->word = 'Test';

        $this->keywordRepository->allows()->findAll()->andReturn(collect([$keyword]));

        $result = $this->service()->matchKeyword('my Test string');

        self::assertTrue($result);
    }

    public function testMatchKeywordWhenKeywordIsNotInGivenStringThanReturnFalse(): void
    {
        $keyword = new Keyword();
        $keyword->word = 'not found';

        $this->keywordRepository->allows()->findAll()->andReturn(collect([$keyword]));

        $result = $this->service()->matchKeyword('my Test string');

        self::assertFalse($result);
    }

    protected function mockeryTestSetUp(): void
    {
        $this->keywordRepository = \Mockery::mock(KeywordRepository::class);
    }

    private function service(): KeywordFilter
    {
        return new KeywordFilter(
            $this->keywordRepository,
        );
    }
}
