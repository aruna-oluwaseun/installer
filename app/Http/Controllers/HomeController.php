<?php

namespace App\Http\Controllers;

use App\Repositories\PostcodeFinder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        set_page_title('Welcome to '.env('APP_NAME'));
        set_active_menu('home');
        return view('index');
    }

    public function packages(Request $request)
    {
        if($request->user())
        {
            if ($request->user()->subscribed()) {
                redirect('account/package');
            }
        }

        $packages = \App\Models\Product::with(['prices' => function($query) {
            $query->available();
        },'features'])->active()->get();

        set_page_title('Packages');
        set_active_menu('benefits/packages');
        return view('packages', compact(['packages']));
    }

    public function benefits()
    {
        set_page_title('Benefits');
        set_active_menu('benefits/benefits');
        return view('benefits');
    }

    public function about()
    {
        set_page_title('About '.env('APP_NAME'));
        set_active_menu('about');
        return view('about');
    }

    public function contact()
    {
        set_page_title('Contact us');
        set_active_menu('contact');
        return view('contact');
    }

    public function storeContact(Request $request)
    {


        $validated = $request->validate([
            'name'   => 'required',
            'email'   => 'required|email',
            'message'   => 'required',
        ]);

        $captcha = $request->input('g-recaptcha-response');

        try {

            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',['secret' => env('GOOGLE_CAPTCHA_SECRET'),'response' => $captcha]);

            if(!$response->successful())
            {
                $response->throw();
            }

            if(!$response->json()['success'])
            {
                Throw new \Exception('Captcha failed',406);
            }

            $validated = (object) $validated;

            Mail::to(env('GENERAL_EMAIL','info@fedca.co.uk'))->send(new \App\Mail\ContactUs($validated));

            if(count(Mail::failures()))
            {
                Throw new \Exception('Error sending message to our team, please try again.');
            }

            return back()->with('success','Thank you for getting in touch we will be in contact soon.');

        } catch (\Throwable $exception)
        {
            report($exception);
        }

        $error = 'Error failed to send message, please try again.';
        if(isset($e)) {
            if($e->getCode() == 406)
            {
                $error = 'You failed the human validation checks.';
            }
        }

        return back()->withInput()->with('error', $error);
    }


    public function howItWorks()
    {
        set_page_title('How it works');
        set_active_menu('benefits/how-it-works');
        return view('how-it-works');
    }

    public function verifiedCompany()
    {
        set_page_title('What is a verified company?');
        set_active_menu('benefits/verified-company');

        return view('what-is-a-verified-member');
    }

    public function terms()
    {
        set_page_title('Terms and conditions');
        set_active_menu('terms');
        return view('terms-and-conditions');
    }

    public function codeOfConduct()
    {
        set_page_title('Code of conduct');
        set_active_menu('conduct');
        return view('code-of-conduct');
    }

    public function termsOfSale()
    {
        set_page_title('Terms of Subscription');
        set_active_menu('terms/subscription');
        return view('terms-of-subscription');
    }

    public function privacyPolicy()
    {
        set_page_title('Privacy policy');
        set_active_menu('privacy');
        return view('privacy-policy');
    }

    public function cookiePolicy()
    {
        set_page_title('Cookie policy');
        set_active_menu('cookie');
        return view('cookie-policy');
    }

    public function standards()
    {
        set_page_title(env('APP_NAME'). ' standards');
        set_active_menu('conduct');
        return view('standards');
    }

    public function unsubscribe()
    {
        $email_sha = request()->get('email');
        'You have unsubscribed '.$email_sha;
    }

    public function getPostcode(Request $request, PostcodeFinder $postcodeFinder)
    {
        $validated = $request->validate([
            'postcode' => 'required'
        ]);

        $res = $postcodeFinder->getPostcode($validated['postcode']);
        return response()->json($res);
    }

    public function recordStat(Request $request)
    {
        if($request->exists('company_id') && $request->exists('type'))
        {
            if(record_stat($request->input('company_id'), $request->input('type')))
            {
                return response()->json([
                    'success' => true
                ]);
            }
        }

        return response()->json([
            'success' => false
        ]);
    }

}
