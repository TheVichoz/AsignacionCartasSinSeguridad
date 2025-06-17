<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EndUser;

class EndUserController extends Controller
{
    /**
     * Devuelve la información del usuario con base en su user_id (id).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserById(Request $request)
    {
        $userId = $request->query('user_id');

        $user = EndUser::find($userId);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Adaptar formato al esperado por el frontend
        $employee = [
            'user_id' => (string) $user->id,
            'display_name' => $user->nombre,
            'email' => $user->correo,
            'location' => $user->ubicacion,
            'cost_center_account_number' => 'N/A', // si no tienes este campo en DB
            'cost_center_name' => $user->centro,
            'supervisor' => $user->supervisor,
            'position' => 'Sin especificar' // opcional
        ];

        return response()->json(['employees' => [$employee]], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
