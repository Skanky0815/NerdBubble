<?php declare(strict_types=1);

namespace App\Console\Commands;

use App\Exceptions\MissingImageException;
use App\Services\Crawler\Crawler as CrawlerService;
use Domains\Article\Services\Crawler as DomainCrawler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\OutputInterface;
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

    /**
     * @var CrawlerService[]|DomainCrawler[]
     */
    private array $allCrawler;

    public function __construct(CrawlerService ...$allCrawler)
    {
        parent::__construct();

        $this->allCrawler = $allCrawler;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $bar = $this->output->createProgressBar(\count($this->allCrawler));
        $this->info('Start import');
        $bar->start();

        foreach ($this->allCrawler as $crawler) {
            $crawlerName = $crawler::class;
            try {
                $crawler->crawl();

                $bar->advance();
                $this->info(" Finished import $crawlerName");
            } catch (MissingImageException $exception) {
                $bar->advance();
                $this->error(" $crawlerName: {$exception->getMessage()}");
                $this->error($exception->getTraceAsString(), OutputInterface::VERBOSITY_DEBUG);
                $this->newLine();
                $this->error($exception->root, OutputInterface::VERBOSITY_DEBUG);
                Log::alert($exception->getMessage(), $exception->getTrace());
            } catch (Throwable $exception) {
                $bar->advance();
                $this->error(" $crawlerName: {$exception->getMessage()}");
                $this->error($exception->getTraceAsString(), OutputInterface::VERBOSITY_DEBUG);
                Log::alert($exception->getMessage(), $exception->getTrace());
            }
        }

        $bar->finish();
        $this->info(' Import done!');
    }
}
