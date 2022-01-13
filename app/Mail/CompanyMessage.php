<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $customer_message;

    /**
     * Create a new message instance.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->customer_message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //info(print_r($this->message,true));
        return $this->subject('You have received a message on '.env('APP_NAME'))->view('emails.new-company-message');
    }
}
