<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EndUserController extends Controller
{
    public function getUserById(Request $request)
    {
$employees = [
    [ "user_id" => "HERNA289", "display_name" => "Andres Hernandez", "email" => "andres_hernandez_grupoti@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "AGUILA45", "display_name" => "Antonio Aguilar", "email" => "antonio_aguilar_movit@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "ARMASA1", "display_name" => "Antonio Armas", "email" => "antonio_armas_teknna@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "TOVARA17", "display_name" => "Axel Tovar", "email" => "axel_tovar_grupoti@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "ANTONE18", "display_name" => "Edith Antonio", "email" => "edith_antonio_teknna3@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "MORENI13", "display_name" => "Isaac Moreno", "email" => "isaac_moreno_teknna@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "TREVIJ18", "display_name" => "Joel Treviño", "email" => "joel_trevino_grupoti@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "LICONJ3", "display_name" => "Josselhly Licona", "email" => "josselhly_licona_hp@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "MEZAL2", "display_name" => "Luis Meza", "email" => "luis_meza_grupoti@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "SALADM2", "display_name" => "Mitzi Salado", "email" => "mitzi_salado_grupoti@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "DELATOA", "display_name" => "Oscar De la Torre", "email" => "oscar_delatorre_movit@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "MARTIR94", "display_name" => "Rodrigo Martinez", "email" => "rodrigo_martinez_movit@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "SIDONR", "display_name" => "Ruben Sidon", "email" => "ruben_sidon_openservice@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "URQUIS", "display_name" => "Santiago Urquides", "email" => "santiago_urquides_conissis@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "PINACU1", "display_name" => "Uriel Pinacho", "email" => "uriel_pinacho_conissis@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "NAVARAK", "display_name" => "Karen Navarro", "email" => "karen_navarro@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "MONTAAM", "display_name" => "Abel Montalvo", "email" => "abel_mata_conissis@whirlpool.com", "location" => "Monterrey IT", "cost_center_account_number" => "80923", "cost_center_name" => "Monterrey IT", "supervisor" => "Karen Navarro", "position" => "Sin especificar" ],
    [ "user_id" => "VICOHZ01", "display_name" => "Vicente Fraga", "email" => "vicohdz.fraga@gmail.com", "location" => "Monterrey IT", "cost_center_account_number" => "TEST01", "cost_center_name" => "Dummy Center", "supervisor" => "Tester", "position" => "Pruebas" ],
    [ "user_id" => "POLOLO01", "display_name" => "Polo López", "email" => "pololohdz2000@gmail.com", "location" => "Monterrey IT", "cost_center_account_number" => "TEST02", "cost_center_name" => "Dummy Center", "supervisor" => "Tester", "position" => "Pruebas" ],
    [ 
    "user_id" => "SANCHEZG1", 
    "display_name" => "Gastón Sánchez Calderón", 
    "email" => "cadetek.contacto@gmail.com", 
    "location" => "Monterrey IT", 
    "cost_center_account_number" => "TEST03", 
    "cost_center_name" => "Grupo México TI", 
    "supervisor" => "Karen Navarro", 
    "position" => "Líder de Proyecto" 
]
];



        $userId = $request->query('user_id');

        $filteredEmployees = array_filter($employees, fn($emp) => $emp['user_id'] === $userId);

        if (empty($filteredEmployees)) {
            return response()->json(["error" => "User not found"], 404);
        }

        return response()->json(["employees" => array_values($filteredEmployees)], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
