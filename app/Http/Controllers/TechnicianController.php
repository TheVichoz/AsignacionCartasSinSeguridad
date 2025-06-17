<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;

/**
 * Class TechnicianController
 *
 * Retrieves technician data from the database instead of using mocked values.
 */
class TechnicianController extends Controller
{
    /**
     * Retrieves a list of technicians from the 'tecnicos' table.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTechnicianList()
    {
        $technicians = Technician::all();

        // Adaptamos el formato al esperado por el frontend
        $formatted = $technicians->map(function ($tech) {
            return [
                "user_id" => $tech->id, // si tienes otro campo diferente a `id`, cámbialo aquí
                "display_name" => $tech->correo, // si tienes nombre aparte, cámbialo
                "email" => $tech->correo,
                "position" => "",
                "location" => "Sin especificar",
                "cost_center_account_number" => "",
                "cost_center_name" => "Sin especificar",
                "supervisor" => ""
            ];
        });

        return response()->json(["technicians" => $formatted], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
