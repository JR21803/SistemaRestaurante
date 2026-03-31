<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ClientSeeder::class,
            EmployeeSeeder::class,
            MenuSeeder::class,
            PlateSeeder::class,
            IngredientSeeder::class,
            MenuPlateSeeder::class,
            OrderSeeder::class,
        ]);
    }
}