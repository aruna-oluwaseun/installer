<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyVerificationDeclined extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $company, $reason)
    {
        $this->company = $company;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Company verification failed')->view('emails.company-verification-declined');
    }
}
