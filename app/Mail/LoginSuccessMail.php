<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $loginDetails;

    public function __construct($user, $loginDetails)
    {
        $this->user = $user;
        $this->loginDetails = $loginDetails;
    }

    public function build()
    {
        return $this->view('emails.login_success')
            ->with([
                'loginDetails' => $this->loginDetails,
            ]);
    }
}