<?php

namespace Database\Seeders;

use App\Models\Plate;
use Illuminate\Database\Seeder;

class PlateSeeder extends Seeder
{
    public function run(): void
    {
        Plate::insert([
            [
                'name' => 'Grilled Chicken',
                'description' => 'Servido con arroz y ensalada',
                'price' => 8.50
            ],
            [
                'name' => 'Beef Burger',
                'description' => 'Con papas fritas y soda',
                'price' => 7.00
            ],
            [
                'name' => 'Natural Juice',
                'description' => 'Jugo fresco de frutas',
                'price' => 2.50
            ]
        ]);
    }
}