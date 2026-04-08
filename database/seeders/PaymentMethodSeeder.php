<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
public function run()
{
    PaymentMethod::create(['name' => 'cash']);
    PaymentMethod::create(['name' => 'card']);
}
}