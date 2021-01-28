<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailEgresados extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $dataTemplate = $this->data;
        
        if(array_key_exists("file",$dataTemplate)){
            try {
                return $this->markdown('Email.emailCita')
                ->subject($dataTemplate["asunto"])
                ->with('mensaje',$dataTemplate["mensaje"])
                ->with('tramite',$dataTemplate["tramite"])
                ->with('asunto',$dataTemplate["asunto"])
                ->with('fecha',$dataTemplate["fecha"])
                ->with('hora',$dataTemplate["hora"])
                ->attachData(base64_decode($dataTemplate["file"]),$dataTemplate["nameFile"]);
            } catch (\Throwable $th) {
            }
        }
        else{
            return $this->markdown('Email.emailCita')
            ->subject($dataTemplate["asunto"])
            ->with('mensaje',$dataTemplate["mensaje"])
            ->with('tramite',$dataTemplate["tramite"])
            ->with('asunto',$dataTemplate["asunto"])
            ->with('fecha',$dataTemplate["fecha"])
            ->with('hora',$dataTemplate["hora"]);
        }
    }
}