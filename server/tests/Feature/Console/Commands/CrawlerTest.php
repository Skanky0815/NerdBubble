<?php

namespace Tests\Feature\Console\Commands;

use App\Models\Keyword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CrawlerTest extends TestCase
{
    use RefreshDatabase;

    public function test_when_no_errors_then_the_articles_with_products_will_be_stored_in_the_database(): void
    {
        Keyword::create([
            'word' => 'der herr der ringe',
        ]);

        Http::fake([
            'https://www.asmodee.de' => Http::response('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>'),
            'https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json' => Http::response(file_get_contents(__DIR__.'/asmodee_news_list_with_products.json')),
        ]);

        $this->artisan('crawler:run')->assertSuccessful();

        $this->assertDatabaseHas('articles', [
            'title' => 'Lila Laster',
            'subTitle' => 'Neue Spiele sind auf dem Weg',
            'date' => '2022-10-26',
            'link' => 'https://www.asmodee.de/news/neue-spiele-sind-auf-dem-weg-67',
            'image' => 'https://assets.svc.asmodee.net/production-asmodeede/null/small_Lila_Laster_0cfe16d145.png',
            'newsType' => 'ASMODEE',
        ]);
        $this->assertDatabaseHas('products', [
            'title' => 'Der Herr der Ringe: Das Kartenspiel – Die Gefährten',
            'link' => 'https://www.asmodee.de/produkte/der-herr-der-ringe-das-kartenspiel-die-gefaehrten',
            'image' => 'https://retail.asmodee.de/media/catalog/product/d/e/der-herr-der-ringe-lcg-die-gefaehrten-841333117900-3dboxl-web.png',
        ]);
    }
}
