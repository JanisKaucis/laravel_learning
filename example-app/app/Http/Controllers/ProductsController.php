<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // index -> show all
    // show -> show single entry
    // GET create -> template form for creating new record
    // POST store -> post for creating new record
    // GET edit -> template for editing record
    // PUT (POST) update -> update database record
    // DELETE (POST) destroy (delete) -> delete record from database
    public function store(Request $request)
    {
        try {
            $this->validate($request,[
                'name' => 'required',
                'description' => 'required'
            ]);
        }catch (ValidationException $e){
            var_dump($e->getMessage());
        return [
            'status'=> 'failed',
            'errors' => $e->errors()
        ];
        }

        //$_POST -> Illuminate\Http\Request;
//        var_dump($request->all());
        $product = new Product($request->all());
        $product->save();

        $product->recipes()->sync($request->get('recipes'));
        return $product;

    }
    public function delete(Product $product)
    {
        $product->delete();
    }
}
