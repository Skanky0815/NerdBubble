<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function login_when_the_credantials_are_correct_then_the_use_will_loggedin(): void
    {
        User::factory()->create([
            'id' => Str::uuid()->toString(),
            'email' => 'admin@nerd-bubble.de'
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'admin@nerd-bubble.de',
            'password' => 'password',
        ]);

        $this->asserApiSpec($response, 'POST', '/api/login');
        $response->assertSuccessful();

        dd($response->json());
    }
}
