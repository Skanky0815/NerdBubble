<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ArticleListControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function whenControllerIsCalledThenResponseSuccess(): void
    {
        $user = User::factory()->create();

        Carbon::setTestNow(Carbon::create(2023, 2, 1));

        Article::factory(10)->create(['date' => '2023-02-01']);
        Article::factory(2)->create(['date' => '2023-01-01']);

        $response = $this->actingAs($user)->getJson('/api/articles');

        $this->asserApiSpec($response, 'GET', '/api/articles');
        $response->assertSuccessful();
        $response->assertJsonCount(10, 'data');
    }
}
