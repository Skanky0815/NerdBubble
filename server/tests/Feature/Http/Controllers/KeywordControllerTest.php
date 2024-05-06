<?php

declare(strict_types=1);

namespace Feature\Http\Controllers;

use App\Models\Article;
use App\Models\Keyword;
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
class KeywordControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function shouldLoadAllKeywords(): void
    {
        $user = User::factory()->create();

        Keyword::factory(count: 12)->create();

        $response = $this->actingAs($user)->getJson('/api/keywords');

        $this->asserApiSpec($response, 'GET', '/api/keywords');
        $response->assertSuccessful();
        $response->assertJsonCount(12, 'data');
    }

    #[Test]
    public function shouldDeleteTheKeyword(): void
    {
        $user = User::factory()->create();

        $keyword = Keyword::factory()->create([
            'word' => 'keyword',
        ]);

        $response = $this->actingAs($user)->deleteJson("/api/keywords/{$keyword->id}");

        $response->assertSuccessful();
        $this->asserApiSpec($response, 'DELETE', '/api/keywords/{keywordId}');
        $this->assertDatabaseMissing('keywords', [
            'word' => 'keyword',
        ]);
    }

    #[Test]
    public function shouldCreateAKeyword_whenRequestIsValid(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/keywords', ['word' => 'keyword']);

        $response->assertCreated();
        $this->asserApiSpec($response, 'POST', '/api/keywords');
        $this->assertDatabaseHas('keywords', [
            'word' => 'keyword',
        ]);
    }

    #[Test]
    public function shouldValidateFields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/keywords', ['word' => '']);

        $response->assertUnprocessable();
    }
}
