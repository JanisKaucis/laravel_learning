<?php

namespace App\Console\Commands;

use App\Services\Import\ImportDataService;
use Illuminate\Console\Command;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import covid data';
    /**
     * @var ImportDataService
     */
    private $importDataService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImportDataService $importDataService)
    {
        parent::__construct();
        $this->importDataService = $importDataService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->importDataService->importData();
        return 0;
    }
}
