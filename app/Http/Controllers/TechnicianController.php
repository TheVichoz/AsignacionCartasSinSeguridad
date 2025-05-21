<?php

namespace App\Http\Controllers;

/**
 * Class TechnicianController
 *
 * Provides a mock endpoint to retrieve technician-related data.
 * This controller simulates a list of technicians, typically used for assignment
 * or filtering purposes within the application.
 *
 * @package App\Http\Controllers
 */
class TechnicianController extends Controller
{
    /**
     * Retrieves a list of technicians with their details.
     *
     * This method returns a hardcoded list of technicians, including relevant fields
     * such as user ID, name, email, position, location, cost center data, and supervisor.
     * The second entry is intentionally left blank to simulate potential incomplete records.
     *
     * @return \Illuminate\Http\JsonResponse JSON response containing technician data.
     */
    public function getTechnicianList()
    {
        // Simulated list of technicians (mocked data)
        $technicians = [
            [
                "user_id" => "PEREZD56",
                "display_name" => "Daniela Perez",
                "email" => "daniela_perez@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "70654",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => "Karen Navarro"
            ],
            [
                // This entry represents a blank or incomplete technician record
                "user_id" => "",
                "display_name" => "",
                "email" => "",
                "position" => "",
                "location" => "",
                "cost_center_account_number" => "",
                "cost_center_name" => "",
                "supervisor" => ""
            ]
        ];

        // Return the technician data as a JSON response
        return response()->json(["technicians" => $technicians], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
