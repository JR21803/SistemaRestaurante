<?php

namespace Database\Seeders;

use App\Models\Plate;
use Illuminate\Database\Seeder;

class PlateSeeder extends Seeder
{
public function run()
{
    Plate::create([
        'name' => 'Hamburguesa',
        'description' => 'Grande',
        'price' => 8
    ]);

    Plate::create([
        'name' => 'Pizza',
        'description' => 'Grande',
        'price' => 16
    ]);
}
}