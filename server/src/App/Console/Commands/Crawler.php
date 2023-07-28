<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Exceptions\MissingImageException;
use App\Services\Crawler\Crawler as CrawlerService;
use Domains\Article\Services\Crawler as DomainCrawler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

class Crawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregate all News from the News Provider.';

    /**
     * @var CrawlerService[]|DomainCrawler[]
     */
    private array $allCrawler;

    public function __construct(CrawlerService ...$allCrawler)
    {
        parent::__construct();

        $this->allCrawler = $allCrawler;
    }

    public function handle(): void
    {
        $bar = $this->output->createProgressBar(\count($this->allCrawler));
        $this->info('Start import');
        $bar->start();

        foreach ($this->allCrawler as $crawler) {
            $this->runCrawler($crawler);
            $bar->advance();
        }

        $bar->finish();
        $this->info(' Import done!');
    }

    private function runCrawler(CrawlerService $crawler): void
    {
        try {
            $crawler->crawl();

            $this->info(sprintf(' Finished import %s', $crawler::class));
        } catch (\Throwable $exception) {
            $this->error(sprintf(' %s: %s', $crawler::class, $exception->getMessage()));
            $this->error($exception->getTraceAsString(), OutputInterface::VERBOSITY_DEBUG);
            $this->newLine();
            $this->error($exception->root, OutputInterface::VERBOSITY_DEBUG);
            Log::alert($exception->getMessage(), $exception->getTrace());
        }
    }
}
