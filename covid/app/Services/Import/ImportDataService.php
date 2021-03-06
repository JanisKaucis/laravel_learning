<?php

namespace App\Services\Import;

use App\Models\CovidData;
use Illuminate\Support\Facades\DB;

class ImportDataService
{
    public function importData()
    {
        $url = 'https://data.gov.lv/dati/lv/api/3/action/datastore_search?resource_id=492931dd-0012-46d7-b415-76fe0ec7c216&sort=_id';
        $baseUrl = 'https://data.gov.lv/dati/lv';
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        $total = $data['result']['total'];
        $count = DB::table('covid_data')->count();
        if($total-$count > 0 ){
            $offset = $count;
        }else{
            $offset = $total;
        }
        $UrlString = $baseUrl;
        $UrlString .= '/api/3/action/datastore_search?sort=_id&';
        $UrlString .= 'offset='.$offset;
        $UrlString .= '&resource_id=492931dd-0012-46d7-b415-76fe0ec7c216';
        $OffsetData = file_get_contents($UrlString);
        $OffsetData = json_decode($OffsetData,true);
        $records = $OffsetData['result']['records'];

        while (count($records) > 0) {
            foreach ($records as $record) {
                CovidData::upsert(
                    $records,$record['_id'], $record
                );
                $OffsetData = $baseUrl. $OffsetData['result']['_links']['next'];
                var_dump($OffsetData);
                $OffsetData = file_get_contents($OffsetData);
                $OffsetData = json_decode($OffsetData, true);
                $records = $OffsetData['result']['records'];
            }
        }
    }
}
