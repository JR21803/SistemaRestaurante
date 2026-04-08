<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $empleadoRole = Role::firstOrCreate(['name' => 'empleado', 'guard_name' => 'web']);
        $clienteRole = Role::firstOrCreate(['name' => 'cliente', 'guard_name' => 'web']);

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
        ])->each(function ($permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        });

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
    }
}