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
    public function __construct($data)
    {
        $this->data = $data;
        $this->name = Auth::user()->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */


    public function build()
    {
        return $this->from('hello@hello.pl', 'Enerji')
        ->subject('Oferta Instalacji Fotowoltaicznej')
        ->replyTo(Auth::user()->email, Auth::user()->name)
        ->markdown('emails.emailOferta')
        ->with('data', $this->data)
        ->with('name', $this->name);
    }
}
