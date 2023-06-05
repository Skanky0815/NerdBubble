<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductMarkControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function when_all_user_logged_in_and_produkt_exists_then_the_product_will_assigned_to_the_user_return_no_content(): void
    {
        $user = User::factory()->create([
            'id' => '5de7002a-cb10-446a-8aaf-75b270a2fd11',
        ]);

        $response = $this->actingAs($user)->postJson('/api/products/1f53e36f-5226-47e1-b384-eaaf8381ea1a/mark');

        $response->assertSuccessful();
        $this->asserApiSpec($response, 'POST', '/api/products/{id}/mark');
    }
}
