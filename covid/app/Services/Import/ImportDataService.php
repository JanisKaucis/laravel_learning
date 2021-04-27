<?php

namespace App\Services\Import;

use App\Models\CovidData;

class ImportDataService
{
    public function importData()
    {
        $url = 'https://data.gov.lv/dati/lv/api/3/action/datastore_search?resource_id=492931dd-0012-46d7-b415-76fe0ec7c216';
        $baseUrl = 'https://data.gov.lv/dati/lv';
        $data = file_get_contents($url);
        $data = json_decode($data, true);
        $records = $data['result']['records'];

        while (count($records) > 0) {
            foreach ($records as $record) {
                CovidData::upsert(
                    [
                        '_id' => $record['_id'],
                        'Datums' => $record['Datums'],
                        'AdministrativiTeritorialasVienibasNosaukums' => $record['AdministrativiTeritorialasVienibasNosaukums'],
                        'ATVK' => $record['ATVK'],
                        'ApstiprinataCOVID19infekcija' => $record['ApstiprinataCOVID19infekcija'],
                        'AktivaCOVID19infekcija' => $record['AktivaCOVID19infekcija'],
                        '14DienuKumulativaSaslimstiba' => $record['14DienuKumulativaSaslimstiba']],
                    ['_id'], [
                    '_id',
                    'Datums',
                    'AdministrativiTeritorialasVienibasNosaukums',
                    'ATVK',
                    'ApstiprinataCOVID19infekcija',
                    'AktivaCOVID19infekcija',
                    '14DienuKumulativaSaslimstiba'],

                );
                var_dump($record['_id']);
            }
            $data = $baseUrl . $data['result']['_links']['next'];
            $data = file_get_contents($data);
            $data = json_decode($data, true);
            $records = $data['result']['records'];
        }
//        var_dump($data['result']['records']);
//        var_dump($data['result']['_links']['next']);
    }
}
