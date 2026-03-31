<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Luis Martinez',
                'email' => 'luisEmpleado@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Maria Hernandez',
                'email' => 'mariaEmpleado@example.com',
                'password' => Hash::make('password'),
            ]
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(['email' => $data['email']], $data);

            Employee::create([
                'user_id' => $user->id,
                'phone_number' => fake()->phoneNumber(),
                'salary' => rand(400, 800),
            ]);

            $user->assignRole('empleado');
        }

        
    }
}