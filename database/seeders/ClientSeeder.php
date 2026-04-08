<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{

public function run()
{
    Client::create([
        'user_id' => 3,
        'phone_number' => '77777777',
        'address' => 'San Salvador'
    ]);
}
}