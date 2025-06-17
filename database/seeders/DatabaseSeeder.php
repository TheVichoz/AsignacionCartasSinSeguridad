<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'employee']);
        Role::firstOrCreate(['name' => 'dss']);

        // Permisos
        Permission::firstOrCreate(['name' => 'crear cartas de asignacion']);
        Permission::firstOrCreate(['name' => 'ver dispositivos asignados']);

        // Usuario admin
        $admin = User::where('email', 'vicohdz.fraga@gmail.com')->first();
        if ($admin) {
            $admin->assignRole('admin');
        }

        // Usuario empleado
        $employee = User::where('email', 'pololohdz2000@gmail.com')->first();
        if ($employee) {
            $employee->assignRole('employee');
        }

        // Usuario DSS
        $dssUser = User::firstOrCreate(
            ['email' => 'paosaenz201@gmail.com'],
            [
                'name' => 'Paola',
                'password' => Hash::make('password123'),
            ]
        );
        if ($dssUser) {
            $dssUser->assignRole('dss');
        }

        // Ejecutar los seeders adicionales
        $this->call([
            TechnicianSeeder::class,
            DeviceSeeder::class,
        ]);

        echo "✅ Roles, usuarios, técnicos y dispositivos creados correctamente.\n";
    }
}
