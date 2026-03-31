<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\IngredientInventory;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            ['name' => 'Pollo', 'category' => 'Carne', 'measurement_unit' => 'kg', 'description' => 'Pollo fresco'],
            ['name' => 'Arroz', 'category' => 'Grano', 'measurement_unit' => 'kg', 'description' => 'arroz blanco'],
            ['name' => 'Tomate', 'category' => 'Vegetal', 'measurement_unit' => 'kg', 'description' => 'Tomate fresco'],
        ];

        foreach ($ingredients as $ingredient) {
            $ing = Ingredient::create($ingredient);

            IngredientInventory::create([
                'ingredient_id' => $ing->id,
                'amount' => 50,
                'purchase_date' => now()->subDays(5),
                'expiration_date' => now()->addDays(10),
                'unit_cost' => 2.5
            ]);
        }
    }
}