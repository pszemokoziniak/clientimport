<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Auth;

class OfertaMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
        $this->name = Auth::user()->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */


    public function build()
    {
        return $this->from(Auth::user()->email, 'Enerji sp. z o.o.')
        ->subject('Oferta Instalacji Fotowoltaicznej')
        ->replyTo(Auth::user()->email, Auth::user()->name)
        ->markdown('emails.emailOferta')
        ->with('emailData', $this->emailData)
        ->with('name', $this->name);
    }
}
