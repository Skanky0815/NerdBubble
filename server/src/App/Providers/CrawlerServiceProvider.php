<?php

declare(strict_types=1);

namespace App\Providers;

use App\Console\Commands\Crawler as CrawlerCommand;
use App\Services\Crawler\AssmodeeProvider;
use App\Services\Crawler\BlueBrixxProvider;
use App\Services\Crawler\Crawler;
use App\Services\Crawler\CrawlerService;
use App\Services\Crawler\FShopProvider;
use App\Services\Crawler\KeywordFilter;
use App\Services\Crawler\RailSimProvider;
use App\Services\Crawler\TswProvider;
use App\Services\Crawler\UlissesSpieleProvider;
use App\Services\Crawler\XboxDynastyProvider;
use Illuminate\Support\ServiceProvider;

class CrawlerServiceProvider extends ServiceProvider
{
    public $singletons = [
        KeywordFilter::class => KeywordFilter::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(CrawlerCommand::class)->needs(Crawler::class)->give(fn () => [
            $this->app->makeWith(CrawlerService::class, ['provider' => $this->app->make(AssmodeeProvider::class)]),
            $this->app->makeWith(CrawlerService::class, ['provider' => $this->app->make(RailSimProvider::class)]),
            $this->app->makeWith(CrawlerService::class, ['provider' => $this->app->make(XboxDynastyProvider::class)]),
            $this->app->makeWith(CrawlerService::class, ['provider' => $this->app->make(TswProvider::class)]),
            $this->app->makeWith(CrawlerService::class, ['provider' => $this->app->make(UlissesSpieleProvider::class)]),
            $this->app->makeWith(CrawlerService::class, ['provider' => $this->app->make(BlueBrixxProvider::class)]),
            $this->app->makeWith(CrawlerService::class, ['provider' => $this->app->make(FShopProvider::class)]),
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // ...
    }
}
