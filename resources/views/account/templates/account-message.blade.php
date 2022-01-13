<!-- Check company status -->
<?php

    $check_account = \App\Models\User::with(['company.services'])->find(current_user_id());
    $message = ''; $class = '';
    if($check_account)
    {
        $plan = $check_account->subscriptions()->first();

        if(!$plan)
        {
            $class = 'alert-info';
            $message = 'To be shown in search results please make sure you have subscribed to one of our <a href="'.url('packages').'">packages</a>';
        }

        if($plan)
        {
            // Cancelled
            if ($check_account->subscription($plan->name)->cancelled()) {
                $class = 'alert-warning';
                $message = 'You subscription is no longer active, you can  <a href="'.url('account/package').'">re-activate your package here</a>';
            }

            // Needs payment
            if ($check_account->hasIncompletePayment($plan->name)) {
                $class = 'alert-danger';
                $message = 'Your payment is overdue, you are not showing in search results  <a href="'.route('cashier.payment', $plan->latestPayment()->id).'">re-activate your package here</a>';

            }
        }

        if($message == '')
        {
            if(!$check_account->company->verified)
            {
                $class = 'alert-info';
                $message = 'Get verified, verified companies show up higher in search results <a href="'.route('verify').'">here</a>';

            }

            if(!$check_account->company->services->count())
            {
                $class = 'alert-info';
                $message = 'To start showing in the installers directory please enter at least one service to your profile, you can do that <a href="'.url('company/profile#services').'">here</a>';
            }
        }

    }
?>

<?php if($message != '') : ?>
    <div class="alert {{ $class }} text-center">{!! $message !!}</div>
<?php endif; ?>

