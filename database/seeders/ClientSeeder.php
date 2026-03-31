<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Juan Perez',
                'email' => 'juan@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Ana Lopez',
                'email' => 'ana@example.com',
                'password' => Hash::make('password'),
            ]
        ];

        foreach ($users as $data) {
            $user = User::create($data);

            Client::create([
                'user_id' => $user->id,
                'phone_number' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ]);
        }
    }
}