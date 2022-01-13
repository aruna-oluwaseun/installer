<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeCompany;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Register view
     */
    public function register()
    {
        if(is_logged_in())
        {
            return \redirect()->to('company/profile');
        }

        set_page_title('Register your company '.env('APP_NAME'));
        set_active_menu('register');
        return view('register');
    }

    /**
     * Store new user
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'company'       => 'required|unique:companies,title',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6'
        ]);

        //dd($validated);
        $company_name = $validated['company'];
        unset($validated['company']);

        $captcha = $request->input('g-recaptcha-response');

        DB::beginTransaction();
        try {

    
            if(!$user = User::create($validated)->fresh()) {
                Throw new \Exception('Failed to create new account :(');
            }

            if(!$company = Company::create(['title' => $company_name, 'user_id' => $user->id])) {
                Throw new \Exception('Failed to create the customer');
            }

            DB::commit();

            // Queue welcome
            Mail::to($user->email)->queue(new WelcomeCompany($user));

            Auth::loginUsingId($user->id);

            // Create Stripe customer
            $user->createAsStripeCustomer(['metadata' => ['user_id' => $user->id,'company_id' => $company->id]]);

            return redirect()->intended('account')->with('success','Welcome to '.env('APP_NAME').' '.$user->first_name);

        }
        catch (\Throwable $e) {
            //print_r($e,true);
            report($e);
            DB::rollBack();
        }

        $error = 'Failed to create your account, please try again';
        if(isset($e)) {
            if($e->getCode() == 406)
            {
                $error = 'You failed the human validation checks';
            }
        }

        return back()->withInput()->with('error',$error);
    }

    /**
     * Login view
     */
    public function login()
    {
        if(is_logged_in())
        {
            return \redirect()->to('company/profile');
        }

        set_page_title('Login');
        set_active_menu('login');
        return view('login');
    }

    /**
     * Login in the user
     * @param Request $request
     */

     public function admin()
    {
        if(is_logged_in())
        {
            return \redirect()->to('company/profile');
        }

        set_page_title('Admin');
        set_active_menu('Admin');
        return view('admin');
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $remember_me = false;
        if($request->exists('remember_me'))
        {
            $remember_me = true;
        }

        if(Auth::attempt($credentials,$remember_me))
        {
            return redirect()->intended('company/profile')->with('success','Welcome back '.get_user()->first_name);
        }

        return back()->withInput()->with('error','Hmmm something is wrong, we could not log you in');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $remember_me = false;
        if($request->exists('remember_me'))
        {
            $remember_me = true;
        }

        if(Auth::attempt($credentials,$remember_me))
        {
            return redirect()->intended('company/profile')->with('success','Welcome back '.get_user()->first_name);
        }

        return back()->withInput()->with('error','Hmmm something is wrong, we could not log you in');
    }

    /**
     * Signout
     */
    public function signout()
    {
        if(Auth::logout())
        {
            return redirect('/')->with('success','You have successfully signed out');
        }

        return back()->with('error','There was an error logging you out, please try again.');
    }


    /**
     * The reset form
     */
    public function forgotPassword()
    {
        set_page_title('Forgot password');
        set_active_menu('password-reset');
        return view('forgot-password');
    }

    /**
     * Send email
     * @param Request $request
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['error' => __($status)]);
    }

    /**
     * Change the password
     */
    public function resetPassword($token)
    {
        if(!$token)
        {
            \redirect(route('password.request'))->with('error','We did not find a valid password reset token.');
        }

        set_page_title('Reset your password');
        return view('password-reset', ['token' => $token]);
    }

    /**
     * Change the password
     */
    public function confirmResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => $password // removed laravel default hash as user model hashes on update
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['error' => [__($status)]]);
    }
}
