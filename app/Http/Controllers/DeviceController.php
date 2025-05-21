<?php

namespace App\Http\Controllers;

/**
 * Class DeviceController
 *
 * Provides endpoints related to available device listings.
 *
 * @package App\Http\Controllers
 */
class DeviceController extends Controller
{
    /**
     * Retrieves a list of available devices.
     *
     * This method returns a predefined (mocked) list of devices, filtering out any entries
     * that have an empty display name. If no valid devices are found, it returns
     * an appropriate error response.
     *
     * @return \Illuminate\Http\JsonResponse JSON response with a list of filtered devices or an error message.
     */
    public function getDeviceList()
    {
        // Simulated list of devices (could be replaced with dynamic data from an API or database)
        $devices = [
            [
                "serial_number" => "7KQ72347",
                "asset_tag" => "AS0011382",
                "display_name" => "Laptop HP ProBook 450 G7",
                "model_category" => "Hardware",
                "state" => "In Use"
            ],
            [
                "serial_number" => "C02ZX01YML7N",
                "asset_tag" => "AS0012399",
                "display_name" => "MacBook Pro 13-inch",
                "model_category" => "Hardware",
                "state" => "Available"
            ],
            [
                "serial_number" => "SN123456789",
                "asset_tag" => "AS0012400",
                "display_name" => "Monitor Dell 24''",
                "model_category" => "Peripheral",
                "state" => "In Stock"
            ],
            [
                "serial_number" => "SN987654321",
                "asset_tag" => "AS0012401",
                "display_name" => "Teclado Mecánico Logitech",
                "model_category" => "Peripheral",
                "state" => "Assigned"
            ],
            [
                "serial_number" => "SN456789123",
                "asset_tag" => "AS0012402",
                "display_name" => "Mouse Inalámbrico MX Master",
                "model_category" => "Peripheral",
                "state" => "Assigned"
            ],
            [
                "serial_number" => "SN1122334455",
                "asset_tag" => "AS0012403",
                "display_name" => "Docking Station HP",
                "model_category" => "Accessory",
                "state" => "Available"
            ],
            [
                "serial_number" => "",
                "asset_tag" => "",
                "display_name" => "",  // ← This entry will be filtered out
                "model_category" => "",
                "state" => ""
            ]
        ];

        // Filter out devices with empty display names
        $filteredDevices = array_filter($devices, fn($device) => !empty($device["display_name"]));

        // Return error response if no valid devices were found
        if (empty($filteredDevices)) {
            return response()->json(["error" => "No available devices"], 200);
        }

        // Return the filtered list of devices as a JSON response
        return response()->json(["devices" => array_values($filteredDevices)], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
