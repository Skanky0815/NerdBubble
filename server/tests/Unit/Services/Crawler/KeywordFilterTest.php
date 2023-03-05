<?php

namespace Tests\Unit\Services\Crawler;

use App\Models\Keyword;
use App\Services\Crawler\KeywordFilter;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class KeywordFilterTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private Keyword $keyword;

    public function test_matchKeyword_when_keyword_is_in_given_string_then_return_true(): void
    {
        $keyword = new Keyword();
        $keyword->word = 'Test';

        $this->keyword->shouldReceive('all')->andReturn(collect([$keyword]));

        $result = $this->service()->matchKeyword('my Test string');

        $this->assertTrue($result);
    }

    public function test_matchKeyword_when_keyword_is_not_in_given_string_than_return_false(): void
    {
        $keyword = new Keyword();
        $keyword->word = 'not found';

        $this->keyword->shouldReceive('all')->andReturn(collect([$keyword]));

        $result = $this->service()->matchKeyword('my Test string');

        $this->assertFalse($result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->keyword = Mockery::mock(Keyword::class);
    }

    private function service(): KeywordFilter
    {
        return new KeywordFilter(
            $this->keyword,
        );
    }
}
