<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EmailEgresados;

class SendEmailEgresados implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data,$user;
    public function __construct($user,$data)
    {
        $this->data = $data;
        $this->user = $user;
    }

    
    public function handle()
    {
        $data = new EmailEgresados($this->data);
        \Mail::to($this->user)->queue($data);
    }
}