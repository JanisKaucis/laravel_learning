<?php

namespace App\Console\Commands;

use App\Services\Import\ImportCurrenciesService;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Currencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getXML';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import currencies from Bank';
    /**
     * @var ImportCurrenciesService
     */
    private $importCurrenciesService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImportCurrenciesService $importCurrenciesService)
    {
        parent::__construct();
        $this->importCurrenciesService = $importCurrenciesService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $this->importCurrenciesService->import();
        return 0;
    }
}
