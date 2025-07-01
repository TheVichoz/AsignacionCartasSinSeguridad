<?php

namespace App\Services;

use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use GuzzleHttp\Client;

class BrevoMailer
{
    protected $apiInstance;

public function __construct()
{
    $config = Configuration::getDefaultConfiguration()->setApiKey(
        'api-key',
        env('BREVO_API_KEY')
    );

    $client = new Client();
    $this->apiInstance = new TransactionalEmailsApi($client, $config);
}


    public function enviarCorreoConLink($toEmail, $toName, $link, $tipoAsignacion)
    {
        $body = "
            <p>Hola Responsable de Revisión,

Has recibido una carta de asignación de tipo <strong>{$tipoAsignacion}</strong>.</p>
            <p><a href=\"{$link}\">Haz clic aquí para revisarla</a></p>
<p>Gracias,
Sistema de Asignación de Equipos.</p>


        ";

        $email = new SendSmtpEmail([
            'subject' => 'Nueva Asignación para Aprobación',
            'sender' => ['name' => 'Sistema de Asignación de Equipos','email' => config('services.brevo.from_address')],
            'to' => [['email' => $toEmail, 'name' => $toName]],
            'htmlContent' => $body
        ]);

        $this->apiInstance->sendTransacEmail($email);
    }

    public function enviarCorreoConAdjunto($toEmail, $toName, $subject, $body, $filePath)
    {
        $fileContent = base64_encode(file_get_contents($filePath));
        $fileName = basename($filePath);

        $email = new SendSmtpEmail([
            'subject' => $subject,
            'sender' => ['name' => 'Sistema de Asignación de Equipos', 'email' => env('BREVO_FROM_ADDRESS')],
            'to' => [['email' => $toEmail, 'name' => $toName]],
            'htmlContent' => $body,
            'attachment' => [
                [
                    'content' => $fileContent,
                    'name' => $fileName
                ]
            ]
        ]);

        $this->apiInstance->sendTransacEmail($email);
    }
public function enviarCorreoParaEmpleado($toEmail, $toName, $link, $tipoAsignacion)
{
    $body = "
        <p>Hola {$toName},</p>
        <p>Has recibido una carta de asignación de tipo <strong>{$tipoAsignacion}</strong>.</p>
        <p>Por favor, da clic en el siguiente enlace para revisarla y firmarla:</p>
        <p><a href=\"{$link}\">Firmar Carta</a></p>
        <p>Gracias,<br>Sistema de Asignación de Equipos</p>
    ";

    $email = new \SendinBlue\Client\Model\SendSmtpEmail([
        'subject' => 'Nueva Carta de Asignación',
        'sender' => [
            'name' => 'Sistema de Asignación de Equipos',
            'email' => config('services.brevo.from_address'),
        ],
        'to' => [[
            'email' => $toEmail,
            'name' => $toName,
        ]],
        'htmlContent' => $body,
    ]);

    $this->apiInstance->sendTransacEmail($email);
}


}
