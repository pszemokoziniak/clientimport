<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;

class RegistrationaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email, 'Rejestracja')
        ->subject('Rejestracja w EnerjiCrm')
        ->replyTo(Auth::user()->email, Auth::user()->name)
        ->markdown('emails.registerEmail')
        ->with('email', $this->email)
        ->with('token', $this->token);
    }
}
