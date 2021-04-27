<?php

namespace App\Http\Controllers;

use App\Services\Show\ShowCurrencyService;
use App\Validators\ShowCurrencyValidator;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * @var ShowCurrencyService
     */
    private ShowCurrencyService $showCurrencyService;
    /**
     * @var ShowCurrencyValidator
     */

    public function __construct(ShowCurrencyService $showCurrencyService)
    {
        $this->showCurrencyService = $showCurrencyService;
    }
    public function show(Request $request)
    {
       $this->showCurrencyService->execute($request);
       $context = $this->showCurrencyService->getContext();
        return view('showConversation',$context);
    }
}
