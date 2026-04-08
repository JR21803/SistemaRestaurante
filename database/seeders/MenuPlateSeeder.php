<?php

namespace Database\Seeders;

use App\Models\MenuPlate;
use Illuminate\Database\Seeder;

class MenuPlateSeeder extends Seeder
{
public function run()
{
    MenuPlate::create([
        'menu_id' => 1,
        'plate_id' => 1,
        'discount_id' => 1,
        'is_available' => true
    ]);
}
}