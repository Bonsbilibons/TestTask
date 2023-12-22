<?php

namespace App\Console\Commands;

use App\Services\LinksService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckLinksExpirationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-links-expiration-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check links expiration date';
    private $linksService;

    /**
     * @param $linksService
     */
    public function __construct(LinksService $linksService)
    {
        parent::__construct();
        $this->linksService = $linksService;
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $links = $this->linksService->getAllExpired();
        foreach ($links as $link) {
            $this->linksService->deactivateLinkByUuid($link->uuid);
            $this->info("Deactivated link with UUID ". $link->uuid);
        }
        $this->info('Done');
    }
}
