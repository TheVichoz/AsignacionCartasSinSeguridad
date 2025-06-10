<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BrevoMailer;
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
            $tipoAsignacion = $request->input('tipo_asignacion', 'Asignación Regular');
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

            // Generate the public URL to the letter with base64 devices and tipo_asignacion
            $link = url("/letter/{$employee['user_id']}") .
                    "?devices={$encodedDevices}" .
                    "&tipo_asignacion=" . urlencode($tipoAsignacion);

            // Send the email using Brevo HTTP API
            $mailer = new BrevoMailer();
            $ok = $mailer->enviarCorreoConLink(
                $employee['email'],
                $employee['display_name'],
                $link,
                $tipoAsignacion
            );

            if (!$ok) {
                return response()->json(['error' => 'No se pudo enviar el correo'], 500);
            }

            // Respond with success message
            return response()->json(['success' => 'Correo enviado correctamente']);
        } catch (Exception $e) {
            // Handle any unexpected errors
            \Log::error('❌ Error en enviarCorreo:', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
