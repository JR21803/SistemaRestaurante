<?php

namespace App\Http\Controllers;

use App\Models\IngredientInventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        return IngredientInventory::all();
    }

    public function store(Request $request)
    {
        return IngredientInventory::create([
            'ingredient_id' => $request->ingredient_id,
            'amount' => $request->amount,
            'purchase_date' => $request->purchase_date,
            'expiration_date' => $request->expiration_date,
            'unit_cost' => $request->unit_cost
        ]);
    }

    public function update(Request $request, $id)
    {
        $inventory = IngredientInventory::findOrFail($id);

        $inventory->update([
            'amount' => $request->amount,
            'purchase_date' => $request->purchase_date,
            'expiration_date' => $request->expiration_date,
            'unit_cost' => $request->unit_cost
        ]);

        return $inventory;
    }

    public function destroy($id)
    {

        $inventory = IngredientInventory::find($id);
        if (!$inventory) {
            return response()->json(['error' => 'Inventario no encontrado'], 404);
        }
        
        $inventory->delete();

        return [
            'message' => 'Inventario eliminado'
        ];
    }
}