<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
        PermissionSeeder::class, 
        UserSeeder::class,
        ClientSeeder::class,
        EmployeeSeeder::class,
        PlateSeeder::class,
        MenuSeeder::class,
        IngredientSeeder::class,
        InventorySeeder::class,
        PaymentMethodSeeder::class,
        DiscountSeeder::class,
        MenuPlateSeeder::class, 
        OrderSeeder::class,
    ]);
}
}