<?php

declare(strict_types=1);

namespace Tests\Feature\Console\Commands;

use App\Models\Provider;
use Database\Seeders\KeywordSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class CrawlerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function when_no_errors_then_the_articles_with_products_will_be_stored_in_the_database(): void
    {
        $this->seed(KeywordSeeder::class);

        Http::fake([
            'https://www.asmodee.de' => Http::response('<html><script src="/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js"/></html>'),
            'https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json' => Http::response(file_get_contents(__DIR__.'/asmodee_news_list_with_products.json')),
            'https://rail-sim.de/forum/wcf/train-sim-world-neuigkeiten/' => Http::response(file_get_contents(__DIR__.'/railSim_news.html')),
            'https://www.xboxdynasty.de/game/xbox-game-pass/' => Http::response(file_get_contents(__DIR__.'/xbox_dynasty.html')),
            'https://cms.dovetailgames.com/api/v1/ghost/hub/tsw/web?limit=24&page=1' => Http::response(file_get_contents(__DIR__.'/tsw3_news_list.json')),
            'https://ulisses-spiele.de/news/' => Http::response(file_get_contents(__DIR__.'/ulissesSpiele_news_list.html')),
            'https://www.bluebrixx.com/de/neuheiten?limit=32' => Http::response(file_get_contents(__DIR__.'/bluebrixx.html')),
            'https://www.f-shop.de/neuheiten/' => Http::response(file_get_contents(__DIR__.'/fshop.html')),
        ]);

        $this->artisan('app:crawl')->assertSuccessful();

        $this->assertDatabaseHas('articles', [
            'provider' => Provider::ASMODEE,
            'title' => 'Lila Laster',
            'subTitle' => 'Neue Spiele sind auf dem Weg',
            'link' => 'https://www.asmodee.de/news/neue-spiele-sind-auf-dem-weg-67',
            'image' => 'https://assets.svc.asmodee.net/production-asmodeede/null/small_Lila_Laster_0cfe16d145.png',
        ]);
        $this->assertDatabaseHas('products', [
            'name' => 'Der Herr der Ringe: Das Kartenspiel – Die Gefährten',
            'link' => 'https://www.asmodee.de/produkte/der-herr-der-ringe-das-kartenspiel-die-gefaehrten',
            'image' => 'https://retail.asmodee.de/media/catalog/product/d/e/der-herr-der-ringe-lcg-die-gefaehrten-841333117900-3dboxl-web.png',
        ]);
        $this->assertDatabaseHas('articles', [
            'provider' => Provider::RAIL_SIM,
            'title' => '[TSW3] Niddertalbahn: Bad Vilbel - Stockheim',
            'image' => 'https://www.rail-sim.de/wp-content/uploads/2016/04/rail-sim_logo.png',
            'link' => 'https://rail-sim.de/forum/thread/39263-tsw3-niddertalbahn-bad-vilbel-stockheim/',
        ]);
        $this->assertDatabaseHas('articles', [
            'provider' => Provider::XBOX_DYNASTY,
            'title' => 'Diese beiden Spiele landen im März auch im Abo',
            'subTitle' => 'Es wurden zwei weitere Spiele vorgemerkt, die im März im Xbox Game Pass Katalog erscheinen werden.',
            'image' => 'https://www.xboxdynasty.de/wp-content/uploads/2017/02/xbox-game-pass-17-150x150.jpeg.pagespeed.ce.2uUj5fj4K3.jpg',
            'link' => 'https://www.xboxdynasty.de/news/xbox-game-pass/diese-beiden-spiele-landen-im-maerz-auch-im-abo/',
        ]);
        $this->assertDatabaseHas('articles', [
            'provider' => Provider::TSW,
            'title' => 'Birmingham Cross-City: Timetable Deep Dive | Pre-Order | Release Day Update',
            'description' => 'In this article we shall be taking you through all the fun nuances and layers you can look forward to in the Cross-City timetable!',
            'image' => 'https://media-cdn.dovetailgames.com/2022/112022/11/XCTTA_01.jpg',
            'link' => 'https://live.dovetailgames.com/live/train-sim-world/articles/article/cross-city-timetable-deep-dive',
        ]);
        $this->assertDatabaseHas('articles', [
            'provider' => Provider::ULISSES_SPIELE,
            'title' => 'Aventuria Stories und Legends',
            'description' => 'Heute mal ein kleinerer Artikel in eigener Sache: Es war ein gutes Stück Arbeit, aber international tut sich nun was – wir machen einen neuen großen englischen Aventuria Kickstarter!',
            'image' => 'https://ulisses-spiele.de/wp-content/uploads/2022/11/01_Aventuria_Allgemein-256x143.webp',
            'link' => 'https://ulisses-spiele.de/aventuria-stories-legends/',
        ]);
        $this->assertDatabaseHas('articles', [
            'provider' => Provider::BLUE_BRIXX,
            'title' => 'BlueBrixx',
        ]);
        $this->assertDatabaseHas('products', [
            'name' => 'Star Trek Spaceship',
            'image' => 'https://www.bluebrixx.com/img/items/105/105543/300/105543_1.jpg',
            'link' => 'https://www.bluebrixx.com/de/neuheiten/105543/Quantum-Colony-Container-Shuttle-6quot%3BVulture6quot%3B-BlueBrixx-Special',
        ]);
        $this->assertDatabaseHas('articles', [
            'provider' => Provider::F_SHOP,
            'title' => 'F-Shop',
        ]);
        $this->assertDatabaseHas('products', [
            'name' => 'DSA5 - Notizbuch des Wüstenreichs',
            'link' => 'https://www.f-shop.de/das-schwarze-auge/rollenspiel/zubehoer/3419/dsa5-notizbuch-des-wuestenreichs',
            'image' => 'https://www.f-shop.de/media/image/6f/9f/24/US25957_0_0999_200x200.jpg',
        ]);
    }
}
