<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder class for creating roles and assigning them to users.
 */
class RolesAndUsersSeeder extends Seeder
{
    /**
     * Runs the seeder.
     *
     * Creates roles and assigns them to specific users in the database.
     *
     * @return void
     */
    public function run(): void
    {
        // ✅ Create roles if they do not exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']); // Admin role
        $employeeRole = Role::firstOrCreate(['name' => 'employee']); // Employee role
        $dssRole = Role::firstOrCreate(['name' => 'dss']); // ✅ New DSS role

        // ✅ Assign ADMIN role to vicohdz.fraga@gmail.com
        $adminUser = User::firstOrCreate(
            ['email' => 'vicohdz.fraga@gmail.com'],
            [
                'name' => 'Victor Hernandez',
                'password' => Hash::make('password123'), // Change the password for security
            ]
        );
        $adminUser->assignRole($adminRole);

        // ✅ Assign EMPLOYEE role to pololohdz2000@gmail.com
        $employeeUser = User::firstOrCreate(
            ['email' => 'pololohdz2000@gmail.com'],
            [
                'name' => 'Polo Lopez',
                'password' => Hash::make('password123'), // Change the password for security
            ]
        );
        $employeeUser->assignRole($employeeRole);

        // ✅ Assign DSS role to victorhernandez.fraga@gmail.com
        $dssUser = User::firstOrCreate(
            ['email' => 'victorhernandez.fraga@gmail.com'],
            [
                'name' => 'Victor DSS',
                'password' => Hash::make('password123'), // Change the password for security
            ]
        );
        $dssUser->assignRole($dssRole); // ✅ Assign DSS role

        echo "✅ Roles and users created successfully.\n";
    }
}
