<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RecipesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class,'home'] );
//
//Route::post('/codelex',function ()
//{
//    return 'posting to codelex';
//});
Route::post('/products',[ProductsController::class,'store'])
    ->name('products.store');
Route::post('/recipes',[ProductsController::class,'store'])
    ->name('recipes.store');
Route::delete('/recipes/{recipe}',[RecipesController::class,'recipes.show'])
    ->name('recipes.delete');
Route::delete('/products/{product}',[ProductsController::class,'delete'])
    ->name('products.delete');
Route::delete('/recipes/{product}',[ProductsController::class,'delete'])
    ->name('recipes.delete');
