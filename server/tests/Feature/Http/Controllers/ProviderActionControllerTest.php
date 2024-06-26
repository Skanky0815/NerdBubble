<?php

declare(strict_types=1);

namespace Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ProviderActionControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function shouldSelectAllField(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        Http::fake([
            'https://www.nerd-bubble.de' => Http::response(file_get_contents(__DIR__.'/Fixtures/nerd-bubble.html')),
        ]);

        $response = $this->actingAs($user)->postJson('/api/providers/actions', [
            'action' => 'TEST_SELECTORS',
            'data' => [
                'aggregateUrl' => 'https://www.nerd-bubble.de',
                'articleSelector' => [
                    'wrapper' => './/*/article',
                    'headline' => './/*/h2',
                    'subHeadline' => '',
                    'description' => '',
                    'image' => './/*/img',
                    'dateSelector' => [
                        'date' => './/*/time',
                        'format' => 'Y-m-d',
                    ],
                    'link' => './/a',
                ],
                'productSelector' => [
                    'wrapper' => '',
                    'name' => '',
                    'image' => '',
                    'link' => '',
                ],
            ],
        ]);

        $response->assertSuccessful();
        $response->assertJsonPath('article.headline', 'EA Play mit neuen In-Game-Belohnungen');
        $response->assertJsonPath('article.date', '2024-05-19');
        $response->assertJsonPath('article.image', 'https://www.xboxdynasty.de/wp-content/uploads/2020/05/ea-play-11-150x150.jpg.pagespeed.ce.NyscDM68Bw.jpg');
        $response->assertJsonPath('article.link', 'https://www.xboxdynasty.de/news/xbox-game-pass/ea-play-mit-neuen-in-game-belohnungen/');
    }
}
