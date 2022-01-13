<?php

namespace App\Mail;

use App\Models\Price;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeThankYou extends Mailable
{
    use Queueable, SerializesModels;

    public $price;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Price $price)
    {
        $this->price = $price;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank you for subscribing')->view('emails.subscribe-thank-you');
    }
}
