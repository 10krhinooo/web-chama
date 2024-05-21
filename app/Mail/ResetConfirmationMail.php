<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Password Reset Confirmation')
                    ->view('reset.confirmation');
    }
}
