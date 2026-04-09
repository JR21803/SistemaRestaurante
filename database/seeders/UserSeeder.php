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
            'email' => 'adminRestaurante@example.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $empleado = User::create([
            'name' => 'Empleado',
            'email' => 'empleado@restaurante.com',
            'password' => bcrypt('password')
        ]);
        $empleado->assignRole('empleado');

        $cliente = User::create([
            'name' => 'Cliente',
            'email' => 'cliente@restaurante.com',
            'password' => bcrypt('password')
        ]);
        $cliente->assignRole('cliente');
    }
}