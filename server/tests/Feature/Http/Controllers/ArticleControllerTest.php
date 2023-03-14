<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_when_controller_is_called_then_response_success(): void
    {
        Carbon::setTestNow(Carbon::create(2023, 0, 13));

        Article::factory(10)->create(['date' => '2023-02-01']);
        Article::factory(2)->create(['date' => '2023-01-01']);

        $response = $this->getJson('/api/articles');

        $response->assertSuccessful();
        $response->assertJsonCount(10, 'data');
    }
}
