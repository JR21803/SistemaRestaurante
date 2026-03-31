<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::insert([
            [
                'name' => 'Main Menu',
                'description' => 'Nuestro menú principal'
            ],
            [
                'name' => 'Drinks',
                'description' => 'Bevidas y jugos'
            ]
        ]);
    }
}