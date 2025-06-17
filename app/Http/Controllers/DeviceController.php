<?php

namespace App\Http\Controllers;

use App\Models\Device;

class DeviceController extends Controller
{
    /**
     * Recupera una lista de dispositivos disponibles desde la base de datos.
     *
     * Solo se incluyen aquellos con nombre visible (display name no vacío).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDeviceList()
    {
        $devices = Device::all()->map(function ($device) {
            return [
                'serial_number' => $device->numero_serie,
                'asset_tag' => 'HBXXXXXX', // Puedes reemplazarlo por un campo real si existe
                'display_name' => $device->categoria ?? 'Sin categoría',
                'model_category' => $device->categoria ?? 'Desconocido',
                'state' => 'Available', // Puedes cambiar esto si tienes un campo de estado real
            ];
        });

        $filteredDevices = $devices->filter(fn($d) => !empty($d['display_name']))->values();

        if ($filteredDevices->isEmpty()) {
            return response()->json(["error" => "No hay dispositivos disponibles"], 200);
        }

        return response()->json(["devices" => $filteredDevices], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
