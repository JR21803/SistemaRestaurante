<?php

namespace Database\Seeders;

use App\Models\MenuPlate;
use Illuminate\Database\Seeder;

class MenuPlateSeeder extends Seeder
{
    public function run(): void
    {
        MenuPlate::insert([
            [
                'menu_id' => 1,
                'plate_id' => 1,
                'discount_id' => null,
            ],
            [
                'menu_id' => 1,
                'plate_id' => 2,
                'discount_id' => null,
            ],
            [
                'menu_id' => 2,
                'plate_id' => 3,
                'discount_id' => null,
            ]
        ]);
    }
}