<?php
namespace App\Http\Controllers;

use App\Services\Import\ImportDataService;
use App\Services\Show\ShowDataService;

class DataController extends Controller
{
    private $importDataService;
    /**
     * @var ShowDataService
     */
    private $showDataService;

    public function __construct(ImportDataService $importDataService,ShowDataService $showDataService)
    {
        $this->importDataService = $importDataService;
        $this->showDataService = $showDataService;
    }
    public function import()
    {
        $this->importDataService->importData();
        echo 'Data Imported';
    }
    public function show()
    {
        $covidData = $this->showDataService->show();
//        var_dump($covidData);
        return view('showData', ['covidData' => $covidData]);
    }
}
