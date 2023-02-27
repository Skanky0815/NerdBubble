<?php

namespace Tests\Feature\Console\Commands;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CrawlerTest extends TestCase
{
    use RefreshDatabase;

    public function test_when_then(): void
    {
        $this->artisan('crawler:run')->assertSuccessful();
        $this->assertDatabaseHas('article', [
            'title' => '',
        ]);
    }
}
