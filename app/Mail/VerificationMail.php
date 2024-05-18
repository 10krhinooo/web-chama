<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tokenLink;

    /**
     * Create a new message instance.
     *
     * @param string $tokenLink
     */
    public function __construct($tokenLink)
    {
        $this->tokenLink = $tokenLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('welcomeEmail')
            ->subject('Verification Email');
    }
}
