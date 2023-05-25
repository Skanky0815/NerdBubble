<?php declare(strict_types=1);

namespace App\Providers;

use App\Console\Commands\Crawler as CrawlerCommand;
use App\Repository\ArticleRepository;
use App\Repository\KeywordRepository;
use App\Services\HttpClientService;
use Domains\Article\Repositories\Articles;
use Domains\Article\Repositories\Keywords;
use Domains\Article\Services\Crawler;
use Domains\Article\Services\HttpClient;
use Domains\Article\Services\Provider\Asmodee;
use Domains\Article\Services\Provider\TrainSimWorld;
use Illuminate\Support\ServiceProvider;

class ArticleProvider extends ServiceProvider
{
    public $bindings = [
        Articles::class => ArticleRepository::class,
        Keywords::class => KeywordRepository::class,
        HttpClient::class => HttpClientService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(CrawlerCommand::class)->needs(Crawler::class)->give(fn () => [
            $this->app->make(Asmodee::class),
            $this->app->make(TrainSimWorld::class),
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
