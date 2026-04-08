<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\IngredientInventory;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{

public function run()
{
    Ingredient::create([
        'name' => 'Pollo',
        'category' => 'Carne',
        'measurement_unit' => 'kg',
        'description' => 'Fresco',
        'stock' => 100
    ]);
}
}