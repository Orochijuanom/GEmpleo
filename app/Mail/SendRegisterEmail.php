<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombre;
    public $destinatario;
    public $token;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $destinatario, $token)
    {   
        $this->nombre = $nombre;
        $this->destinatario = $destinatario;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.registermail')
                    ->subject('Confirmacion de registro en la plataforma Gempleo')
                    ->with([
                        'nombre' => $this->nombre,
                        'destinatario' => $this->destinatario,
                        'token' => $this->token,
                    ]);
    }
}

