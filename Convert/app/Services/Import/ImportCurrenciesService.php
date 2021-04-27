<?php
namespace App\Services\Import;

use App\Models\Currency;

class ImportCurrenciesService
{
    public function import()
    {
        $url = 'https://www.bank.lv/vk/ecb.xml';
        $xml = simplexml_load_file($url);
        $data = json_encode($xml);
        $data = json_decode($data,true);

        foreach ($data['Currencies']['Currency'] as $currencyData){
                Currency::updateOrCreate(
                ['Currency_id' => $currencyData['ID']],
                ['currency_id' => $currencyData['ID'],
                    'currency_rate' => (int)((float) $currencyData['Rate']*100000)]
            );
        }


    }
}
