<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class NotificacionCorreo
 *
 * This mailable class is responsible for constructing and sending
 * the device assignment notification email to the corresponding employee.
 *
 * It includes user and assignment details that will be injected into the email view.
 *
 * @package App\Mail
 */
class NotificacionCorreo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The name of the employee who will receive the email.
     *
     * @var string
     */
    public $nombreUsuario;

    /**
     * The type of assignment being notified (e.g., new, temporary).
     *
     * @var string
     */
    public $tipoAsignacion;

    /**
     * The ID of the employee receiving the assignment.
     *
     * @var string
     */
    public $user_id;

    /**
     * The base64-encoded list of assigned devices.
     *
     * @var string
     */
    public $encodedDevices;

    /**
     * Create a new message instance.
     *
     * @param string $nombreUsuario
     * @param string $tipoAsignacion
     * @param string $user_id
     * @param string $encodedDevices
     */
    public function __construct($nombreUsuario, $tipoAsignacion, $user_id, $encodedDevices)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->tipoAsignacion = $tipoAsignacion;
        $this->user_id = $user_id;
        $this->encodedDevices = $encodedDevices;
    }

    /**
     * Build the message.
     *
     * This method defines the view to be used for the email content.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notificacion');
    }
}
