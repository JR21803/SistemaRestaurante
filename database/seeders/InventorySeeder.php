<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\IngredientInventory;

class InventorySeeder extends Seeder
{
public function run()
{
    IngredientInventory::create([
        'ingredient_id' => 1,
        'amount' => 100,
        'purchase_date' => '2026-04-01',
        'expiration_date' => '2026-05-01',
        'unit_cost' => 2
    ]);
}
}