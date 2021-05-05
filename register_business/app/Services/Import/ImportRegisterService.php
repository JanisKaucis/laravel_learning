<?php
namespace App\Services\Import;

use App\Models\RegisterData;
use Illuminate\Support\Facades\DB;

class ImportRegisterService
{
    public function importRegister()
    {
        $url = 'https://data.gov.lv/dati/lv/api/3/action/datastore_search?resource_id=25e80bf3-f107-4ab4-89ef-251b5b9374e9&sort=_id';
        $baseUrl = 'https://data.gov.lv/dati/lv';
        $data = file_get_contents($url);
        $data = json_decode($data,true);
        $total = $data['result']['total'];
        $count = DB::table('register_data')->count();
        if($total-$count > 0 ){
            $offset = $count;
        }else{
            $offset = $total;
        }
        $UrlString = $baseUrl;
        $UrlString .= '/api/3/action/datastore_search?sort=_id&';
        $UrlString .= 'offset='.$offset;
        $UrlString .= '&resource_id=25e80bf3-f107-4ab4-89ef-251b5b9374e9';
        $OffsetData = file_get_contents($UrlString);
        $OffsetData = json_decode($OffsetData,true);
        $records = $OffsetData['result']['records'];
        while (count($records) > 0){
            foreach ( $records as $record) {
            RegisterData::upsert(
                $records,$record['_id'],$record
            );
                $OffsetData = $baseUrl. $OffsetData['result']['_links']['next'];
                var_dump($OffsetData);
                $OffsetData = file_get_contents($OffsetData);
                $OffsetData = json_decode($OffsetData, true);
                $records = $OffsetData['result']['records'];
            }
        }
        if (count($records) == 0){
            echo 'Done';
        }
    }
}
