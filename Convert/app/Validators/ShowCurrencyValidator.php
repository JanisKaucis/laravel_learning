<?php
namespace App\Validators;
use App\Models\Currency;
use Illuminate\Http\Request;


class ShowCurrencyValidator
{
    private string $error = '';
    private int $amount = 0;

    public function validate(Request $request)
    {
        if ($request->input('convert') !== null){
            if (!is_numeric($request->input('amount'))){
                $this->error = 'Enter numbers only';
                $this->amount = 0;
            } elseif($request->input('amount') == 0){
                $this->error = 'Cannot convert zero';
                $this->amount = 0;
            }else{
                $this->amount = $request->input('amount');
            }
        }

    }
    public function getError(): string
    {
        return $this->error;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
