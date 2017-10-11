<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $link;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Links $link)
    {
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME')
                    ->with([
                            'user' => ucfirst($this->link->firstname).' '.ucfirst($this->link->lastname),
                            'quantity' => $link->quantity,
                            'details'  => $link->details ,])
                    ->subject('Reserva pagada')
                    ->markdown('email.notification');
    }
}
