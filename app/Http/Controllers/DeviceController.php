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
        // Simulated list of devices (realistic dummy data from Excel)
        $devices = [
            [ "serial_number" => "5CD203LLOM", "asset_tag" => "HB000199", "display_name" => "Chromebook C645", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD2491D81", "asset_tag" => "HB001056", "display_name" => "Probook 640 G9", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4288J9T", "asset_tag" => "HB003094", "display_name" => "Elitebook 650 G10", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4288JBQ", "asset_tag" => "HB003122", "display_name" => "Elitebook 650 G10", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD450CBDM", "asset_tag" => "HB003912", "display_name" => "HP ZBook Power 15 G10", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4525SSJ", "asset_tag" => "HB003936", "display_name" => "HP EliteBook 640 G11", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4525S9Z", "asset_tag" => "HB004158", "display_name" => "HP EliteBook 640 G11", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4525SCN", "asset_tag" => "HB004203", "display_name" => "HP EliteBook 640 G11", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4525SG0", "asset_tag" => "HB004269", "display_name" => "HP EliteBook 640 G11", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4525SGJ", "asset_tag" => "HB004283", "display_name" => "HP EliteBook 640 G11", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4525SGQ", "asset_tag" => "HB004289", "display_name" => "HP EliteBook 640 G11", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD4525SGS", "asset_tag" => "HB004291", "display_name" => "HP EliteBook 640 G11", "model_category" => "Laptop", "state" => "Available" ],
            [ "serial_number" => "5CD511D7W0", "asset_tag" => "HB004371", "display_name" => "HP Pro c640 Chromebook", "model_category" => "Laptop", "state" => "Available" ],
        ];

        // Filter out devices with empty display names
        $filteredDevices = array_filter($devices, fn($device) => !empty($device["display_name"]));

        if (empty($filteredDevices)) {
            return response()->json(["error" => "No available devices"], 200);
        }

        return response()->json(["devices" => array_values($filteredDevices)], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
