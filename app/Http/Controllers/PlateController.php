<?php

namespace App\Http\Controllers;

use App\Models\Plate;
use Illuminate\Http\Request;

class PlateController extends Controller
{
    public function index() { return Plate::all(); }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric'
        ]);
    }

    public function show($id)
    {
        return Plate::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $plate = Plate::findOrFail($id);
        $plate->update($request->all());
        return $plate;
    }

    public function destroy($id)
    {
        Plate::destroy($id);
        return ['message' => 'deleted'];
    }

    
}