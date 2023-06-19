<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
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

        $product = Product::factory()->create([
            'id' => 'd6346eae-075e-4713-b3ee-9b75a9b6a3e1',
        ]);

        $response = $this->actingAs($user)->postJson("/api/products/{$product->id}/mark");

        $response->assertSuccessful();
        $this->asserApiSpec($response, 'POST', '/api/products/{id}/mark');
        $this->assertDatabaseHas('product_user', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }
}
