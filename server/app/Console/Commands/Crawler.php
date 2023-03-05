<?php

namespace App\Console\Commands;

use App\Services\Crawler\AsmodeeCrawler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

class Crawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(
        private readonly AsmodeeCrawler $asmodee,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $this->asmodee->crawl();
        } catch (Throwable $exception) {
            Log::alert($exception->getMessage(), $exception->getTrace());
        }
    }
}
