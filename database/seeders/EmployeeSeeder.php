<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{

public function run()
{
    Employee::create([
        'user_id' => 2, // empleado
        'phone_number' => '77777777',
        'salary' => 500
    ]);
}
}