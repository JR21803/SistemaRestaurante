<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@test.com',
            'password' => bcrypt('123456')
        ]);
        $admin->assignRole('admin');

        $empleado = User::create([
            'name' => 'Empleado',
            'email' => 'empleado@test.com',
            'password' => bcrypt('123456')
        ]);
        $empleado->assignRole('empleado');

        $cliente = User::create([
            'name' => 'Cliente',
            'email' => 'cliente@test.com',
            'password' => bcrypt('123456')
        ]);
        $cliente->assignRole('cliente');
    }
}