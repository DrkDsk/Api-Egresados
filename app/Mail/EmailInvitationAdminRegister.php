<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailInvitationAdminRegister extends Mailable
{
    use Queueable, SerializesModels;
    protected $url;
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function build()
    {
        return $this->markdown('Email.emailInvitationAdminRegister')
        ->with('url',$this->url)
        ->subject('Invitación de Registro de Administrador');
    }
}
