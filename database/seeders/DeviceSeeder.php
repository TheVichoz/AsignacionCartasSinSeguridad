<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        $devices = [
            [
                'serial_number' => 'GCG30509LC',
                'brand' => 'HP',
                'model' => 'EliteBook 840 G3',
                'operating_system' => 'Windows 10 Pro',
                'status' => 'Disponible',
                'type' => 'Laptop',
            ],
            [
                'serial_number' => 'GCG30510LC',
                'brand' => 'HP',
                'model' => 'EliteBook 840 G4',
                'operating_system' => 'Windows 10 Pro',
                'status' => 'Disponible',
                'type' => 'Laptop',
            ],
            [
                'serial_number' => 'GCG30511LC',
                'brand' => 'Dell',
                'model' => 'Latitude 7490',
                'operating_system' => 'Windows 10 Pro',
                'status' => 'Disponible',
                'type' => 'Laptop',
            ],
            [
                'serial_number' => 'GCG30512LC',
                'brand' => 'Samsung',
                'model' => 'Galaxy Tab S6',
                'operating_system' => 'Android',
                'status' => 'Disponible',
                'type' => 'Tablet',
            ],
            [
                'serial_number' => 'GCG30513LC',
                'brand' => 'Apple',
                'model' => 'iPhone 11',
                'operating_system' => 'iOS',
                'status' => 'Disponible',
                'type' => 'Celular',
            ],
        ];

        DB::table('dispositivos')->insert($devices);

        echo "✅ Dispositivos insertados correctamente.\n";
    }
}
