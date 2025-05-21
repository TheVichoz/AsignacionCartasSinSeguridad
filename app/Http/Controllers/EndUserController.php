<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class EndUserController
 *
 * Simulates retrieving user data for validation and display in other parts of the system.
 * This controller provides mocked employee records to support testing and prototyping.
 *
 * @package App\Http\Controllers
 */
class EndUserController extends Controller
{
    /**
     * Retrieves user data by filtering based on the provided user ID.
     *
     * This method simulates fetching user details from a predefined list of employees.
     * If the provided user ID matches an entry, the corresponding user data is returned.
     * If no match is found, an error response is sent.
     *
     * @param Request $request HTTP request object containing the 'user_id' query parameter.
     * @return \Illuminate\Http\JsonResponse JSON response with the matching employee data or an error message.
     */
    public function getUserById(Request $request)
    {
        // Simulated employee data (mocked database)
        $employees = [
            [
                "user_id" => "GUEVAE67",
                "display_name" => "Edgar Guevara",
                "email" => "pololohdz2000@gmail.com",
                "position" => "My Position",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "70654",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => "Karen Navarro"
            ],
            [
                "user_id" => "PEREZD56",
                "display_name" => "Daniela Perez",
                "email" => "daniela_perez@whirlpool.com",
                "position" => "Engineer",
                "location" => "Guadalajara",
                "cost_center_account_number" => "80923",
                "cost_center_name" => "Guadalajara Tech",
                "supervisor" => "Luis Fernández"
            ]
        ];

        // Retrieve the 'user_id' from the request query parameters
        $userId = $request->query('user_id');

        // Filter the list of employees to find a match by user_id
        $filteredEmployees = array_filter($employees, function ($emp) use ($userId) {
            return $emp['user_id'] === $userId;
        });

        // Return a 404 response if no employee is found
        if (empty($filteredEmployees)) {
            return response()->json(["error" => "User not found"], 404);
        }

        // Return matched employee data as a JSON response
        return response()->json(["employees" => array_values($filteredEmployees)], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
