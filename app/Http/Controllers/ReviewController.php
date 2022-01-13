<?php

namespace App\Http\Controllers;

use App\Mail\NewReview;
use App\Mail\ReviewDeclined;
use App\Mail\ReviewUs;
use App\Mail\YouHaveBeenReviewed;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index($id)
    {
        $review = \App\Models\Review::whereRaw("SHA1(CONCAT('FED',id,'CA')) = '".$id."'")->first();

        if(!$review) {
            abort(404);
        }

        set_page_title('Action review');
        return view('action-review',compact(['review']));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required',
            'decline_reason' => 'exclude_unless:status,declined|required|nullable'
        ]);

        DB::beginTransaction();
        try {

            $validated['pending_until'] = null;

            if($validated['status'] == 'approve-pending')
            {
                $dt = new \DateTime();
                $validated['status'] = 'pending';
                $validated['pending_until'] = $dt->modify('+ 7 days')->format('Y-m-d');
            }

            if($request->exists('verified'))
            {
                $validated['verified_by'] = 'Fedca';
                $validated['verified'] = date('Y-m-d H:i:s');
            }


            $review = \App\Models\Review::with(['company.user'])->whereRaw("SHA1(CONCAT('FED',id,'CA')) = '".$id."'")->first();

            if(!$review->update($validated))
            {
                Throw new \Exception('Failed to update the review');
            }


            // Send email to the company and reviewer
            if($validated['status'] != 'declined')
            {
                if($company_email = $review->company->user->email)
                {
                    Mail::to($company_email)->queue(new YouHaveBeenReviewed($review));
                }

            }
            else
            {
                Mail::to($review->email)->queue(new ReviewDeclined($review));
            }

            DB::commit();

            return redirect(route('business_profile',[$review->company_id,slug($review->company->title)]))->with('success', 'Review actioned');

        }
        catch (\Throwable $e)
        {
            report($e);
            DB::rollBack();
        }

        return back()->withInput()->with('error', 'Failed to action this review');
    }

    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required',
            'company_id'    => 'required',
            'title'         => 'required',
            'description'   => 'required',
            'rating'        => 'required',
        ]);

        $captcha = $request->input('g-recaptcha-response');

        $validated['rating'] = $validated['rating'] / 2;

        // Verify captcha
        DB::beginTransaction();
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

            if($request->exists('proof'))
            {
                $key = $request->input('proof.key');
                $filename = microtime();//$request->input('proof.name');
                if($request->exists('proof.content_type'))
                {
                    if($ext = mime2ext($request->input('proof.content_type')))
                    {
                        $filename .= '.'.$ext;
                    }
                }
                $dir = 'reviews/';

                if(Storage::copy($key, $dir.$filename))
                {
                    $validated['proof'] = $dir.$filename;
                    Storage::setVisibility( $validated['proof'],'public');
                }
            }

            if(!$review = Review::create($validated)) {
                Throw new \Exception('Failed to save review');
            }

            // send review for approval
            Mail::to(env('GENERAL_EMAIL','info@fedca.co.uk'))->queue(new NewReview($review));

            DB::commit();

            return back()->with('success','Thank you '.$validated['first_name'].' for your review, reviews can take around 24-72 hours to show up.');

        } catch (\Throwable $e) {
            report($e);
            DB::rollBack();
            if($e->getCode() == 406)
            {
                $error = 'You failed the human validation checks';
            }
        }

        return back()->withInput()->with('error',isset($error) ? $error : 'Failed to save the review, please try again');
    }

    /**
     * Share a review link
     * @param Request $request
     */
    public function shareReviewLink(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'message'   => 'nullable'
        ]);

        try {
            Mail::to($validated['email'])->send(new ReviewUs($validated['name'],$validated['message']));

            if(!count(Mail::failures()))
            {
                return back()->with('success','Review link has been shared with '.$validated['email']);
            }

            return back()->with('error','Failed to share review link, please try again');
        } catch (\Throwable $exception) {
            report($exception);
        }

        return back()->with('error','An error has occurred sharing a review link, please try again');
    }
}
