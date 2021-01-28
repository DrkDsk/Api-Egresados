<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\EmailInvitationAdminRegister;

class SendEmailInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email,$link;
    public function __construct($email,$link)
    {
        $this->email = $email;
        $this->link = $link;
    }

    public function handle()
    {
        $link = new EmailInvitationAdminRegister($this->link);
        \Mail::to($this->email)->queue($link);
    }
}