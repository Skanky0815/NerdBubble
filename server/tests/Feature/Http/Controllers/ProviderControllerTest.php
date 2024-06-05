<?php

declare(strict_types=1);

namespace Feature\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ProviderControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function shouldLoadAllProviders(): void
    {
        $user = User::factory()->create();

        Provider::factory(5)->create();

        $response = $this->actingAs($user)->getJson('/api/providers');

        $this->asserApiSpec($response, 'GET', '/api/providers');
        $response->assertSuccessful();
        $response->assertJsonCount(5, 'data');
    }

    #[Test]
    public function shouldLoadProviderById(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $provider = Provider::factory()->create();

        $response = $this->actingAs($user)->getJson("/api/providers/{$provider->id}");

        $this->asserApiSpec($response, 'GET', '/api/providers/{providerId}');
        $response->assertSuccessful();
    }

    #[Test]
    public function shouldStoreNewProvider(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $provider = Provider::factory()->make([
            'name' => 'Test Provider',
        ]);

        $response = $this->actingAs($user)->postJson('/api/providers', $provider->attributesToArray());

        $this->asserApiSpec($response, 'POST', '/api/providers');
        $response->assertCreated();
        $this->assertDatabaseHas('providers', [
            'name' => 'Test Provider',
        ]);
    }
}
