<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProviderActionRequest;
use Domains\Article\Services\SelectorTester;
use Domains\Article\ValueObjects\ArticleSelector;
use Domains\Article\ValueObjects\DateSelector;

class ProviderActionController extends Controller
{
    public function __construct(
        private readonly SelectorTester $httpCrawler,
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ProviderActionRequest $request)
    {
        $data = $request->validated('data');

        $data['articleSelector']['dateSelector'] = new DateSelector(...$data['articleSelector']['dateSelector']);

        return $this->httpCrawler->crawl($data['aggregateUrl'], new ArticleSelector(...$data['articleSelector']));
    }
}
