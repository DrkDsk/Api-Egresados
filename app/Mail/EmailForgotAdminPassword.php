<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForgotAdminPassword extends Mailable
{
    use Queueable, SerializesModels;
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function build()
    {
        $url = $this->url;

        return $this->markdown('auth.passwords.emailForgotAdminPassword',[
            'url' => $url
        ])
        ->subject('Reestablecer Contraseña');
    }
}
