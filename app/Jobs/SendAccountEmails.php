<?php

namespace App\Jobs;

use App\Mail\YouAreNotVisible;
use App\Models\EmailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAccountEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $today = new \DateTime('now');

        // None visible subscribers
        $companies = \App\Models\Company::with(['user'])->active()->get();

        if($companies->count()) {
            $less_2_weeks = new \DateTime('now');
            $less_2_weeks->modify('- 2 weeks');

            foreach ($companies as $company) {

                $alerted = EmailAlert::where('company_id',$company->id)->orderBy('id','DESC')->first();

                if($alerted)
                {
                    $created = new \DateTime($alerted->created_at);

                    // Alerted within two weeks already
                    if($created->format('Y-m-d') >= $less_2_weeks->format('Y-m-d'))
                    {
                        continue;
                    }
                }

                if(!$company->services->count() || !$company->address_data)
                {
                    Mail::to($company->user->email)->queue(new YouAreNotVisible($company->user));

                    if(!count(Mail::failures())) {
                        EmailAlert::create([
                            'company_id'    => $company->id,
                            'user_id'       => $company->user->id,
                            'type'          => 'not_visible',
                            'to'            => $company->user->email
                        ]);
                    }
                }

            }
        }

    }
}
