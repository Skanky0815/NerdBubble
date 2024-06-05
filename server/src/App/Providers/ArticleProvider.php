<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\ArticleRepository;
use App\Repository\KeywordRepository;
use App\Repository\ProviderRepository;
use App\Services\HttpClientService;
use Domains\Article\Repositories\Articles;
use Domains\Article\Repositories\Keywords;
use Domains\Article\Repositories\Providers;
use Domains\Article\Services\HttpClient;
use Illuminate\Support\ServiceProvider;

class ArticleProvider extends ServiceProvider
{
    public $bindings = [
        Articles::class => ArticleRepository::class,
        Keywords::class => KeywordRepository::class,
        HttpClient::class => HttpClientService::class,
        Providers::class => ProviderRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
