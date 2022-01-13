<?php

namespace App\Http\Controllers;

use App\Mail\CompanyVerificationDeclined;
use App\Mail\CompanyVerified;
use App\Mail\VerifyCompany;
use App\Models\Company;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyLiabilityController extends Controller
{
    /**
     * Submit documents
     */
    public function getVerified()
    {
        $company = Company::with(['references'])->find(current_user_company_id());

        if(!$company) {
            abort(404);
        }

        set_active_menu('account/verify-me');
        set_page_title('Get verified');
        return view('account.get-verified', compact(['company']));
    }

    /**
     * Store and submit
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'reference.1.full_name'         => 'sometimes|required',
            'reference.1.phone'             => 'sometimes|required|numeric',
            'reference.1.email'             => 'sometimes|required|email',
            'reference.1.works_completed'   => 'sometimes|required',
            'reference.2.full_name'         => 'sometimes|required',
            'reference.2.phone'             => 'sometimes|required|numeric',
            'reference.2.email'             => 'sometimes|required|email',
            'reference.2.works_completed'   => 'sometimes|required',
            'reference.3.full_name'         => 'sometimes|required',
            'reference.3.phone'             => 'sometimes|required|numeric',
            'reference.3.email'             => 'sometimes|required|email',
            'reference.3.works_completed'   => 'sometimes|required',
        ]);

        $company = Company::with(['references'])->find(current_user_company_id());

        $data = $request->except('_method','_token');

        //dd($data);
        DB::beginTransaction();
        try {

            if($request->exists('liability.key'))
            {
                $key = $request->input('liability.key');
                //$filename = $request->input('liability.name');
                $filename = microtime();//$request->input('proof.name');
                if($request->exists('liability.content_type'))
                {
                    if($ext = mime2ext($request->input('liability.content_type')))
                    {
                        $filename .= '.'.$ext;
                    }
                }
                $dir = 'companies/'.current_user_company_id().'/liability/';

                if(Storage::copy($key, $dir.$filename))
                {
                    $liability = $dir.$filename;
                    Storage::setVisibility($liability,'public');

                    $company->liability = $liability;

                    if(!$company->save())
                    {
                        Throw new \Exception('Failed to save public liability document');
                    }
                }
            }

            if(isset($data['reference']))
            {
                foreach($data['reference'] as $key => $datum)
                {
                    if(isset($data['reference'][$key]['ignore'])) {
                        continue; // already filled in
                    }

                    $datum['company_id'] = current_user_company_id();

                    if(!Reference::create($datum))
                    {
                        Throw new \Exception('Failed to save reference');
                    }
                }
            }

            // Refernces added and liability then email
            if($company->liability)
            {
                $message = 'Thank you for supplying your references. We will update you once checks have been made.';

                Mail::to(env('GENERAL_EMAIL','info@fedca.co.uk'))->queue(new VerifyCompany($company));
            }
            else
            {
                $message = 'Thank you for supplying references we, just need your public liability now';
            }


            if(isset($liability))
            {
                Mail::to(env('GENERAL_EMAIL','info@fedca.co.uk'))->queue(new VerifyCompany($company));

                $message = 'Thank you for supplying your references and public liability, we will review your documents and update when you have been verified.';
            }

            DB::commit();

            return back()->with('success',$message);

        } catch (\Throwable $e) {
            report($e);
            DB::rollBack();
            if(isset($liability))
            {
                Storage::delete($liability);
            }
        }

        return back()->withInput()->with('error','Failed to save, please make sure all details are filled in ');
    }

    /**
     * Action a verifications
     */
    public function verify($id)
    {
        $company = Company::with(['references'])->whereRaw("SHA1(CONCAT('FED',id,'CA')) = '".$id."'")->first();

        if(!$company) {
            abort(404);
        }

        set_page_title('Action company');
        return view('action-company',compact(['company']));
    }

    /**
     * Action a verifications
     */
    public function actionVerify(Request $request, $id)
    {
        $validated = $request->validate([
           'status' => 'required',
           'reason' => 'exclude_unless:status,declined|required'
        ]);

        $company = Company::with(['references','user'])->whereRaw("SHA1(CONCAT('FED',id,'CA')) = '".$id."'")->first();

        if(!$company) {
            return back()->withInput()->with('error','We could not find the company or references');
        }

        if($validated['status'] == 'declined')
        {
            Mail::to($company->user->email)->send(new CompanyVerificationDeclined($company,$validated['reason']));

            if(!count(Mail::failures()))
            {
                return back()->with('success','Company has been emailed to obtain new information');
            }
        }

        // Approved
        else
        {
            $company->verified = date('Y-m-d H:i:s');

            if($company->save())
            {
                Mail::to($company->user->email)->queue(new CompanyVerified($company));

                if(!count(Mail::failures()))
                {
                    return back()->with('success','Company has been verified they have been emailed the good news');
                }
            }
        }

        return back()->withInput()->with('error','Failed to update company verification details.');
    }

    public function destroyReference($id)
    {
        if(Reference::destroy($id))
        {
            return back()->with('success','Reference deleted, select decline, enter the reason and hit submit');
        }

        return back()->withInput()->with('error','Failed to delete the reference');
    }
}
