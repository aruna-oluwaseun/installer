<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeThankYou;
use App\Models\Price;
use App\Models\User;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Geocoder\Laravel\ProviderAndDumperAggregator as Geocoder;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = User::with(['company'])->find(current_user_id());

        set_active_menu('account');
        set_page_title('Account');
        return view('account.account',compact(['account']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Geocoder $geocode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Geocoder $geocode)
    {

        $user = User::with(['company'])->find(current_user_id());
        $validate_email = '';

        if($request->exists('user.email'))
        {
            if($request->input('user.email') != $user->email)
            {
                $validate_email = ['user.email' => 'required|email|unique:users,email'];
            }
        }

        $request->validate([
            $validate_email,
            'user.first_name'               => 'required',
            'user.last_name'                => 'required',
            'company.title'                 => 'required',
            'company.address_data.line1'    => 'required',
            'company.address_data.city'     => 'required',
            'company.address_data.postcode' => 'required',
            'company.address_data.country'  => 'required',
        ]);

        $user_data = $request->input('user');
        $company_data = $request->input('company');

        if(isset($company_data['address_data']['gps_lat']) && $company_data['address_data']['gps_lat'] != '' && isset($company_data['address_data']['gps_lng']) && $company_data['address_data']['gps_lng'] != '')
        {
            $company_data['gps_lat'] = $company_data['address_data']['gps_lat'];
            $company_data['gps_lng'] = $company_data['address_data']['gps_lng'];
        }

        // Geocode the address
        else
        {
            $geo_data = $geocode->geocode($company_data['address_data']['line1'].', '.$company_data['address_data']['city'].', '.$company_data['address_data']['postcode'].', '.$company_data['address_data']['country'])->get();

            if($geo_data->count())
            {
                $company_data['gps_lat'] = $geo_data->first()->getCoordinates()->getLatitude();
                $company_data['address_data']['gps_lat'] = $company_data['gps_lat'];
                $company_data['gps_lng'] = $geo_data->first()->getCoordinates()->getLongitude();
                $company_data['address_data']['gps_lng'] =  $company_data['gps_lng'];
            }
            else
            {
                info('Could not geocode the following address'.print_r($company_data['address_data'],true));
            }
        }

        DB::beginTransaction();
        try {

           if(!$user->update($user_data))
           {
               Throw new \Exception('Failed to update your personal details.');
           }

           if(!$user->company()->update($company_data))
           {
               Throw new \Exception('Failed to update company details.');
           }

           DB::commit();

           return back()->with('success','Your details have been successfully saved.');

        } catch (\Throwable $e) {
            report($e);
            DB::rollBack();
        }

        return back()->withInput()->with('error','Hmmm we were unable to save your details, please try again.');
    }

    /**
     * View Payment Methods
     */
    public function paymentMethod()
    {
        $account = User::with(['company'])->find(current_user_id());
        $intent = $account->createSetupIntent();
        $payment_methods = $account->defaultPaymentMethod();//$account->paymentMethods();

        if(!$account->stripe_id) {
            // Create Stripe customer
            $account->createAsStripeCustomer(['metadata' => ['user_id' => $account->id,'company_id' => $account->company->id]]);
        }

        set_active_menu('account/payment');
        set_page_title('Account');
        return view('account.update-payment-method',compact(['account','intent','payment_methods']));
    }

    /**
     * Store Payment Methods
     */
    public function storePaymentMethod(Request $request)
    {
        $request->validate([
           'payment_method' => 'required'
        ]);

        $user = get_user();

        $payment_method_id = $request->input('payment_method');

        try {
            $user->updateDefaultPaymentMethod($payment_method_id);

            /*if ($user->hasPaymentMethod())
            {
                $user->updateDefaultPaymentMethod($payment_method_id);
            }
            else
            {
                $user->addPaymentMethod($payment_method_id);
            }*/

            if($request->ajax()) {
                return response()->json([
                   'success' => true
                ]);
            }

            return back()->with('success','Payment method saved.');
        }
        catch (\Throwable $e)
        {
            report($e);
        }

        if($request->ajax()) {

        }

        if($request->ajax()) {
            return response()->json([
                'success' => false
            ]);
        }

        return back()->with('error','Sorry an error occurred saving your payment method. Please try again.');

    }

    /**
     * Update Payment Methods
     */
    public function updatePaymentMethod(Request $request)
    {

    }

    public function package()
    {
        $account = User::with(['company.services'])->find(current_user_id());
        $plan = $account->subscriptions()->active()->first();

        // No plan
        if(!$plan) {
            return redirect('packages');
        }

        $plan->cost = null;
        $plan->billing_period = null;
        $plan->cancelled = false;
        $plan->on_grace_period = false;

        if($plan->stripe_plan) {
            $price = Price::where('stripe_id',$plan->stripe_plan)->first();

            if($price)
            {
                $plan->cost = $price->cost;
                $plan->billing_period = $price->billing_period;
            }

        }

        // Handle checks for valid subscriptions here
        if($account->subscription($plan->name)->cancelled())
        {
            $plan->cancelled = true;
        }

        if ($account->subscription($plan->name)->onGracePeriod())
        {
            $plan->on_grace_period = true;
        }


        set_active_menu('account/package');
        set_page_title('Account');
        return view('account.package',compact(['account','plan']));
    }

    public function subscribe($id)
    {
        // Get the package
        $account = User::with(['company.services'])->find(current_user_id());
        $price = Price::with(['product.features'])->findOrFail($id);

        if($account->subscriptions()->active()->count())
        {
            if($account->company->status != 'active')
            {
                $account->company->status = 'active';
                $account->company->save();
            }

            return redirect('account/package')->with('success','You are already subscribed');
        }

        if(!$price->product) {
            abort(404);
        }

        $package = $price->product;

        if ($account->hasDefaultPaymentMethod()) {
            $intent = null;
        }
        else
        {
            $intent = $account->createSetupIntent();
        }

        set_active_menu('account/package');
        set_page_title('Account');
        return view('account.subscribe-to-package',compact(['account','intent','package','price']));
    }

    public function storeSubscription(Request $request, $id)
    {
        $account = User::with(['company'])->find(current_user_id());
        $price = Price::with(['product.features'])->findOrFail($id);
        $package = $price->product;

        DB::beginTransaction();
        try {

            // Make trial
            if($package->trial_amount && $package->trial_interval)
            {
                $dt = new \DateTime();
                $future = new \DateTime();
                $future->modify('+ '.$package->trial_amount.' '.$package->trial_interval);

                $trial_days = $future->diff($dt)->days;
            }

            if(isset($trial_days))
            {
                $account->newSubscription($package->title, $price->stripe_id)
                    ->trialDays($trial_days)
                    ->create($account->defaultPaymentMethod()->id);
            }
            else
            {
                $account->newSubscription($price->product->title, $price->stripe_id)
                    ->create($account->defaultPaymentMethod()->id);
            }

            $account->agree_terms_sale_and_conduct = date('Y-m-d H:i:s');

            if(!$account->save())
            {
                report('Failed to save the agree to terms but the user has agreed');
            }

            $account->company->status = 'active';

            if(!$account->company->save())
            {
                report('Failed to update the company status to active');
            }

            // Send email
            Mail::to($account->email)->queue(new SubscribeThankYou($price));

            DB::commit();

            return redirect('account/package')->with('success','You have subscribed to our '.$package->title.' package');
        }
        catch (\Throwable $e)
        {
            report($e);
            DB::rollBack();
        }

        return back()->with('error','Failed to subscribe you to your chosen package, please try again.');
    }


    public function settings()
    {
        return 'this is the account settings area';
    }

    public function notifications()
    {
        return 'this is the account notifications area for managing notification preferences';
    }

    public function getVerified()
    {
        return 'This is the verification page, this will be live shortly';
    }
}
