<?php
namespace App\Services\Show;

use App\Models\CovidData;

class ShowDataService
{

    public function show()
    {
        $data =  CovidData::all(['*']);
        $data = json_decode($data, true);
        return $data;
    }
}
