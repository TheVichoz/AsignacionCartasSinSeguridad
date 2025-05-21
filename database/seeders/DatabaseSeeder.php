<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class `DatabaseSeeder`
 * 
 * Seeder for creating roles, permissions, and assigning roles to users.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Runs the seeder.
     * 
     * Creates roles, permissions, and assigns roles to specific users in the database.
     *
     * @return void
     */
    public function run(): void
    {
        // ✅ Creating roles if they do not exist
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'employee']);
        Role::firstOrCreate(['name' => 'dss']); // ✅ New DSS role

        // ✅ Creating permissions
        Permission::firstOrCreate(['name' => 'crear cartas de asignacion']); // "Create assignment letters"
        Permission::firstOrCreate(['name' => 'ver dispositivos asignados']); // "View assigned devices"

        // ✅ Assign the "admin" role to a specific user
        $admin = User::where('email', 'vicohdz.fraga@gmail.com')->first();
        if ($admin) {
            $admin->assignRole('admin');
        }

        // ✅ Assign the "employee" role to a specific user
        $employee = User::where('email', 'pololohdz2000@gmail.com')->first();
        if ($employee) {
            $employee->assignRole('employee');
        }

        // ✅ Create user with "dss" role if they do not exist
        $dssUser = User::firstOrCreate(
            ['email' => 'paosaenz201@gmail.com'],
            [
                'name' => 'Paola',
                'password' => Hash::make('password123'), // Required for standard authentication
            ]
        );

        if ($dssUser) {
            $dssUser->assignRole('dss'); // ✅ Assign DSS role
        }

        echo "✅ Roles and users created successfully.\n";
    }
}
