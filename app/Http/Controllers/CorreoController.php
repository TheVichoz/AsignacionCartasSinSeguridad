<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionCorreo;
use Exception;

/**
 * Class CorreoController
 *
 * Handles the process of sending assignment notification emails to employees.
 *
 * @package App\Http\Controllers
 */
class CorreoController extends Controller
{
    /**
     * Sends an email to the employee with assignment details and a link to the digital letter.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function enviarCorreo(Request $request)
    {
        try {
            // Retrieve required data from the request
            $userId = $request->input('user_id');
            $tipoAsignacion = $request->input('tipo_asignacion');
            $assignedDevices = $request->input('assigned_devices', []);

            // Encode the assigned devices list to safely pass it via URL
            $encodedDevices = base64_encode(json_encode($assignedDevices));

            // Retrieve employee data using internal service
            $endUserController = new EndUserController();
            $response = $endUserController->getUserById(new Request(['user_id' => $userId]));
            $data = $response->getData(true);

            // Ensure employee exists
            if (empty($data['employees'])) {
                return response()->json(['error' => 'Empleado no encontrado'], 404);
            }

            $employee = $data['employees'][0];

            // Send the email using the NotificacionCorreo Mailable class
            Mail::to($employee['email'])->send(new NotificacionCorreo(
                $employee['display_name'],
                $tipoAsignacion,
                $employee['user_id'],
                $encodedDevices // ✅ sent encoded for secure transport
            ));

            // Respond with success message
            return response()->json(['success' => 'Correo enviado correctamente']);
        } catch (Exception $e) {
            // Handle any unexpected errors
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
