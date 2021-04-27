<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recipe;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    //
    public function show(Recipe $recipe)
    {
        return $recipe;
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'products' => ['required','array']
            ]);
        } catch (ValidationException $e) {
            return [
                'status' => 'failed',
                'errors' => $e->errors()
            ];
        }

        //$_POST -> Illuminate\Http\Request;
//        var_dump($request->all());
        $recipe = new Recipe($request->all());
        $recipe->save();

        $recipe->products()->sync($request->get('products'));
        return $recipe;

    }
    public function delete(Recipe $recipe)
    {
        $recipe->delete();
    }
}
