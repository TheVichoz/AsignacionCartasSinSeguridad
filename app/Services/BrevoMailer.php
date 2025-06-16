<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrevoMailer
{
    /**
     * Envía un correo electrónico con el enlace a la carta.
     *
     * @param string $toEmail
     * @param string $toName
     * @param string $link
     * @param string $tipoAsignacion
     * @return \Illuminate\Http\JsonResponse|bool
     */
    public function enviarCorreoConLink($toEmail, $toName, $link, $tipoAsignacion)
    {
        $asunto = "Carta de Asignación - Acción requerida";

        $contenidoHTML = "
            <p>Hola {$toName},</p>
            <p>Has recibido una carta de asignación de tipo <strong>{$tipoAsignacion}</strong>.</p>
            <p>Por favor, da clic en el siguiente enlace para revisarla y firmarla:</p>
            <p><a href='{$link}'>Firmar Carta</a></p>
            <p>Gracias,<br>Sistema de Asignación de Equipos</p>
        ";

        $response = Http::withHeaders([
            'api-key' => env('BREVO_API_KEY'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://api.brevo.com/v3/smtp/email', [
            'sender' => [
                'name' => 'Sistema de Asignación de Equipos',
                'email' => 'vicohdz.fraga@gmail.com', // 🔑 correo remitente autorizado
            ],
            'to' => [[
                'email' => $toEmail,
                'name' => $toName,
            ]],
            'subject' => $asunto,
            'htmlContent' => $contenidoHTML,
        ]);

        if (!$response->successful()) {
            Log::error('❌ Error al enviar correo con Brevo', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            // Devuelve el error completo al frontend para depuración
            return response()->json([
                'error' => 'Fallo Brevo: ' . $response->status() . ' → ' . $response->body()
            ], 500);
        }

        return true;
    }
}
