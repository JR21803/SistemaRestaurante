<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creacion de roles

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);

        $empleadoRole = Role::firstOrCreate(['name' => 'empleado', 'guard_name' => 'api']);

        $clienteRole = Role::firstOrCreate(['name' => 'cliente', 'guard_name' => 'api']);

        // Creacion de permisos

        collect([
            'ver pedidos',
            'crear pedidos',
            'actualizar pedidos',
            'eliminar pedidos',
            'gestionar menu',
            'gestionar usuarios',
            'gestionar platos',
            'gestionar inventario',
            'gestionar descuentos',
            'ver facturas',
        ]) ->each(function ($permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        });


        // Asignacion de permisos a roles

        $adminRole->givePermissionTo(Permission::all());

        $empleadoRole->givePermissionTo([
            'ver pedidos',
            'crear pedidos',
            'actualizar pedidos',
            'ver facturas'
        ]);

        $clienteRole->givePermissionTo([
            'ver pedidos',
        ]);

        // Asignacion de roles a usuarios

         $userAdmin = User::firstOrCreate(['email' => 'adminRestaurante@example.com',
        ], [
            'name' => 'Administrador',
            'password' => bcrypt('password'),
        ]);

    

        $userAdmin->assignRole($adminRole);


    }
}
