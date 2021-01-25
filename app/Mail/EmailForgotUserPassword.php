<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForgotUserPassword extends Mailable
{
    use Queueable, SerializesModels;
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        return $this->markdown('Email.emailForgotUserPassword')
        ->with('token',$this->token)
        ->subject('Recuperación de Contraseña');
    }
}
