<?php
namespace App\Services\Show;

use App\Models\Currency;
use App\Validators\ShowCurrencyValidator;
use Illuminate\Http\Request;

class ShowCurrencyService
{
    private ShowCurrencyValidator $showCurrencyValidator;
    private $context;

    public function __construct(ShowCurrencyValidator $showCurrencyValidator)
{
    $this->showCurrencyValidator = $showCurrencyValidator;
}

    public function execute(Request $request)
    {
        $exchange = '';
        if ($request->input('convert') !== null) {
            $symbol = $request->input('currencies');
            $this->showCurrencyValidator->validate($request);
            if ($this->showCurrencyValidator->getAmount() == 0){
                $exchange = '';
                $symbol = '';
            }else{
                $currency = Currency::where('currency_id', '=',$symbol)->firstOrFail();
                $symbol = $currency->Currency_id;
                $exchange = $this->showCurrencyValidator->getAmount()*$currency->currency_rate/100000;
            }
        }
        $this->context = [
            'error' => $this->showCurrencyValidator->getError(),
            'result' => $exchange.' '.$symbol
        ];
    }
    public function getContext()
    {
        return $this->context;
    }
}
