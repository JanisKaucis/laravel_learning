<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('welcome');
    }
    public function main()
    {
        $user = new User(['name'=>'Janis','email'=>'jk@jk.lv']);

        return view('home');
    }
}
