<?php
namespace App\Services\Show;

use App\Models\RegisterData;
use Illuminate\Http\Request;

class ShowRegisterService
{

    public function showByRegCode(Request $request)
    {   $company = '';
        if ($request->input('search') !== null) {
            $regCode = $request->input('regCode');
            $company = RegisterData::where('regcode',$regCode)->first();
            $companyName = $company['name'];
        }
        $context = [
            'company' => $companyName
        ];
        return $context;
    }
}
