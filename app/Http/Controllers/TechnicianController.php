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
     * @return \Illuminate\Http\JsonResponse JSON response containing technician data.
     */
    public function getTechnicianList()
    {
        // Simulated list of technicians
        $technicians = [
            [
                "user_id" => "ALVARA56",
                "display_name" => "Alejandro Alvarado1",
                "email" => "alejandro_alvarado_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "REYNAA22",
                "display_name" => "Alondra Reyna",
                "email" => "alondra_reyna_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Ramos Arizpe",
                "cost_center_account_number" => "",
                "cost_center_name" => "Ramos Arizpe",
                "supervisor" => ""
            ],
            [
                "user_id" => "HERNA289",
                "display_name" => "Andres Hernandez",
                "email" => "andres_hernandez_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "NONEA2",
                "display_name" => "Antonio Ivon",
                "email" => "antonio_ivon_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Guadalajara CAAW",
                "cost_center_account_number" => "",
                "cost_center_name" => "Guadalajara CAAW",
                "supervisor" => ""
            ],
            [
                "user_id" => "TOVARA17",
                "display_name" => "Axel Tovar",
                "email" => "axel_tovar_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "ALVARC40",
                "display_name" => "Cinthya Alvarez",
                "email" => "cinthya_alvarez_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Ramos Arizpe",
                "cost_center_account_number" => "",
                "cost_center_name" => "Ramos Arizpe",
                "supervisor" => ""
            ],
            [
                "user_id" => "GONZAE91",
                "display_name" => "Eber Gonzalez",
                "email" => "eber_gonzalez_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Ramos Arizpe",
                "cost_center_account_number" => "",
                "cost_center_name" => "Ramos Arizpe",
                "supervisor" => ""
            ],
            [
                "user_id" => "LARAE21",
                "display_name" => "Edgar Lara",
                "email" => "edgar_lara_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Ramos Arizpe",
                "cost_center_account_number" => "",
                "cost_center_name" => "Ramos Arizpe",
                "supervisor" => ""
            ],
            [
                "user_id" => "LUGOE5",
                "display_name" => "Edgar Lugo",
                "email" => "edgar_lugo_grupoti@whirlpool.com",
                "position" => "",
                "location" => "México CEDIS",
                "cost_center_account_number" => "",
                "cost_center_name" => "México CEDIS",
                "supervisor" => ""
            ],
            [
                "user_id" => "LOPEZE77",
                "display_name" => "Emmanuel Lopez",
                "email" => "emmanuel_lopez_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "ESTRAE14",
                "display_name" => "Erick Estrada",
                "email" => "erick_estrada_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Celaya ERNA",
                "cost_center_account_number" => "",
                "cost_center_name" => "Celaya ERNA",
                "supervisor" => ""
            ],
            [
                "user_id" => "SANCHG27",
                "display_name" => "Gaston Sanchez",
                "email" => "gaston_sanchez_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "PINEDG2",
                "display_name" => "Gerardo Pineda",
                "email" => "gerardo_pineda_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "TREVJI18",
                "display_name" => "Joel Treviño",
                "email" => "joel_trevino_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "COVARJ9",
                "display_name" => "Josue Covarrubias",
                "email" => "josue_covarrubias_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "SALADM2",
                "display_name" => "Mitzi Salado",
                "email" => "mitzi_salado_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Monterrey IT",
                "cost_center_account_number" => "",
                "cost_center_name" => "Monterrey IT",
                "supervisor" => ""
            ],
            [
                "user_id" => "JIMENP19",
                "display_name" => "Pedro Jimenez",
                "email" => "pedro_jimenez_grupoti@whirlpool.com",
                "position" => "",
                "location" => "Celaya ERNA",
                "cost_center_account_number" => "",
                "cost_center_name" => "Celaya ERNA",
                "supervisor" => ""
            ]
        ];

        return response()->json(["technicians" => $technicians], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
