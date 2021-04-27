<?php
namespace App\Http\Controllers;

use App\Services\Import\ImportCurrenciesService;

class ImportCurrenciesController
{
    /**
     * @var ImportCurrenciesService
     */
    private $importCurrenciesService;

    public function __construct(ImportCurrenciesService $importCurrenciesService)
    {
        $this->importCurrenciesService = $importCurrenciesService;
    }
    public function import()
    {
        $this->importCurrenciesService->import();
        echo 'IMPORTED CURRENCIES';
    }
}
