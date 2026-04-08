<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{

public function run()
{
    Discount::create([
        'name' => 'Promo $5',
        'type' => 'fixed',
        'amount' => 5,
        'min_total' => 25,
        'description' => 'Descuento fijo'
    ]);

    Discount::create([
        'name' => 'Promo 10%',
        'type' => 'percentage',
        'percent' => 10,
        'description' => 'Descuento porcentual'
    ]);
}
}