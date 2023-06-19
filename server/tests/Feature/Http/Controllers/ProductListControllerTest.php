<?php declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductListControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function when_controller_is_called_then_a_list_with_marked_products_will_returned(): void
    {
        $user = User::factory()->create(['id' => 'cd393e5d-a8c2-4461-ad54-8ac589e01064']);

        $product = Product::factory()->create(['id' => 'f14cf9cf-b041-40d2-9441-dbc841c68303']);
        $product->users()->attach($user, ['id'=> 'e54a8ab0-cd92-4c74-8ae3-6321dfdeb896']);

        $response = $this->actingAs($user)->getJson('/api/marked-products');

        $response->assertSuccessful();
        $this->asserApiSpec($response, 'GET', '/api/marked-products');
    }
}
