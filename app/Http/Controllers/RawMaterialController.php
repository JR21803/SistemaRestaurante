<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    public function index()
    {
        return Ingredient::all();
    }

    public function store(Request $request)
    {
        return Ingredient::create($request->all());
    }

    public function show($id)
    {
        return Ingredient::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->all());
        return $ingredient;
    }

    public function destroy($id)
    {
        Ingredient::destroy($id);
        return ['message' => 'Eliminado'];
    }
}