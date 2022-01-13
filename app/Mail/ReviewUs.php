<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewUs extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $name;
    public $custom_message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $message)
    {
        $this->user = User::with(['company'])->find(current_user_id());
        $this->name = $name;
        $this->custom_message = $message;

        info('The user '.print_r($this->user,true));
        info('The name '.$name);
        info('The messsage '.$message);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->user->first_name.' has asked if you could kindly review them on Fedca';
        return $this->subject($subject)->view('emails.please-review-us');
    }
}
