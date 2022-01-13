<?php

namespace App\Http\Controllers;

use App\Mail\CompanyMessage;
use App\Mail\VerifyCompany;
use App\Models\Company;
use App\Models\CompanyStat;
use App\Models\Message;
use App\Models\Reference;
use App\Models\Service;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    /**
     * Public company profile view
     */
    public function index()
    {
    

        set_active_menu('Blog');
        set_page_title('Blog');
        return view('blog');
    }

    /**
     * View edit page
     */
    public function detail($id)
    {
        
        
        set_page_title('Manage your company profile');
        return view('detail');
    }

    /**
     * Update company
     * @param Request $request
     */
    public function update(Request $request)
    {
        $company = Company::with(['services'])->find(current_user_company_id());

        DB::beginTransaction();
        try {
            // Profile Details -----

                $company_data = $request->input('company');

                if($request->exists('company.avatar'))
                {
                    $key = $request->input('company.avatar.key');
                    $filename = $request->input('company.avatar.name');
                    $dir = 'companies/'.current_user_company_id().'/avatar/';

                    if(Storage::copy($key, $dir.$filename))
                    {
                        $company_data['avatar'] = $dir.$filename;
                        Storage::setVisibility($company_data['avatar'],'public');
                    }
                    //$path = Storage::putFile('/companies/'.current_user_company_id().'/avatar', new File($file),'public');
                }

                if($request->exists('company.cover_photo'))
                {
                    $key = $request->input('company.cover_photo.key');
                    $filename = $request->input('company.cover_photo.name');
                    $dir = 'companies/'.current_user_company_id().'/cover-photo/';

                    if(Storage::copy($key, $dir.$filename))
                    {
                        $company_data['cover_photo'] = $dir.$filename;
                        Storage::setVisibility($company_data['cover_photo'],'public');
                    }
                }


            // Profile Details -----preg_match('/^http(s)?:\/\//', $url)

            // Profile Services -----
                if($request->exists('service.new_service') && $request->input('service.new_service') != '')
                {
                    $request->validate([
                       'service.new_service' => 'unique:services,title'
                    ]);

                    $new_service = ['title' => $request->input('service.new_service'),'slug' => Str::slug($request->input('service.new_service'))];
                }

                if($request->exists('service.service_id') && $request->input('service.service_id') != '')
                {
                    $link_service = $request->input('service.service_id');
                }

                $service_description = null;
                if($request->exists('service.description'))
                {
                    $service_description = $request->input('service.description');
                }

                $service_image = null;
                if($request->exists('service.image'))
                {
                    $key = $request->input('service.image.key');
                    $filename = $request->input('service.image.name');
                    $dir = 'companies/'.current_user_company_id().'/services/';

                    if(Storage::copy($key, $dir.$filename))
                    {
                        $service_image = $dir.$filename;
                        Storage::setVisibility($service_image,'public');
                    }
                }

            // Profile Services -----

            if(isset($company_data))
            {
                if(!$company->update($company_data))
                {
                    Throw new \Exception('Failed to update your details. Please try again');
                }
            }


            if(isset($new_service))
            {
                if(!$service = Service::create($new_service))
                {
                    Throw new \Exception('Failed to create new service. Please try again.');
                }

                $company->services()->attach($service,['description' => $service_description,'image' => $service_image]);
            }

            if(isset($link_service))
            {
                $company->services()->attach($link_service,['description' => $service_description,'image' => $service_image]);
            }

            DB::commit();

            return back()->with('success','Your details have been updated.');

        }
        catch (\Throwable $e) {
            report($e);
            DB::rollBack();
        }

        return back()->withInput()->with('error',(isset($e) ? $e->getMessage() : 'Unknown error occurred, please try again, if the problem persists please contact us.'));
    }

    /**
     * Delete avatar
     */
    public function deleteAvatar()
    {
        $company = get_company();

        if(!$company) {
            return back()->with('error','Sorry we could not the find the resource you are after.');
        }

        try {

            if(!$company->avatar)
            {
                Throw new \Exception('No company avatar found to update');

            }

            if(!Storage::exists($company->avatar))
            {
                Throw new \Exception('No company avatar found to update');

            }

            if(!Storage::delete($company->avatar))
            {
                Throw new \Exception('Failed to delete company avatar');
            }

            $company->avatar = null;
            if(!$company->save())
            {
                Throw new \Exception('Company avatar deleted but we could not update the database');
            }

            return back()->with('success','Company avatar deleted');

        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('error', isset($e) ? $e->getMessage() : 'Unknown error occurred, please try again, if the problem persists please contact us.');

    }

    /**
     * Delete avatar
     */
    public function deleteCoverPhoto()
    {
        $company = get_company();

        if(!$company) {
            return back()->with('error','Sorry we could not the find the resource you are after.');
        }

        try {

            if(!$company->cover_photo)
            {
                Throw new \Exception('No cover photo found to update');

            }

            if(!Storage::exists($company->cover_photo))
            {
                Throw new \Exception('No cover photo found to update');

            }

            if(!Storage::delete($company->cover_photo))
            {
                Throw new \Exception('Failed to delete cover photo');
            }

            $company->cover_photo = null;
            if(!$company->save())
            {
                Throw new \Exception('Cover photo deleted but we could not update the database');
            }

            return back()->with('success','Cover photo deleted');

        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('error', isset($e) ? $e->getMessage() : 'Unknown error occurred, please try again, if the problem persists please contact us.');

    }

    /**
     * Delete Service Image
     */
    public function deleteServicePhoto($id)
    {
        $company = Company::with(['services'])->find(current_user_company_id());

        if(!$company) {
            return back()->with('error','Sorry we could not the find the resource you are after.');
        }

        try {

            $service = $company->services()->find($id);

            if(!$service->pivot->image)
            {
                Throw new \Exception('No image found for this service');

            }

            if(!Storage::exists($service->pivot->image))
            {
                Throw new \Exception('No image found for this service');

            }

            if(!Storage::delete($service->pivot->image))
            {
                Throw new \Exception('Failed to delete service image');
            }

            $service->image = null;
            if(!$service->save())
            {
                Throw new \Exception('Service image deleted but we could not update the database');
            }

            return back()->with('success','Service image deleted');

        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('error', isset($e) ? $e->getMessage() : 'Unknown error occurred, please try again, if the problem persists please contact us.');

    }

    /**
     * Update service
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateService(Request $request, $id)
    {
        $data['description'] = $request->input('description');

        try {
            if($request->exists('image'))
            {
                $key = $request->input('image.key');
                $filename = $request->input('image.name');
                $dir = 'companies/'.current_user_company_id().'/services/';

                if(Storage::copy($key, $dir.$filename))
                {
                    $data['image'] = $dir.$filename;
                    Storage::setVisibility($data['image'],'public');
                }
            }

            $company = Company::with(['services'])->find(current_user_company_id());

            if($company->services()->updateExistingPivot($id,$data))
            {
                return redirect('company/profile#services')->with('success','Service updated!');
            }
        } catch (\Throwable $exception) {
            Bugsnag::notifyException($exception);
        }

        return redirect('company/profile#services')->withInput()->with('error','Failed to update service. Please try again.');
    }

    /**
     * Delete service
     */
    public function deleteService($id)
    {
        $company = Company::with(['services'])->find(current_user_company_id());

        if(!$company) {
            return back()->with('error','Sorry we could not the find the resource you are after.');
        }

        try {

            if($image = $company->services()->find($id)->pivot->image)
            {
                info('Image = '. $image);
                if(!Storage::delete($image))
                {
                    Throw new \Exception('Failed to delete cover photo');
                }
            }

            if($company->services()->detach($id))
            {
                return redirect('company/profile#services')->with('success','Service removed!');
            }

        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('error', 'Error removing service, please try again, if the problem persists please contact us.');

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function contact(Request $request, $id)
    {
        //dd($request->all());

        if(! $company = Company::find($id) )
        {
            return back()->with('error','We could not locate the company you are after.');
        }

        $validated = $request->validate([
            'full_name'  => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:11',
            'message' => 'required'
        ]);

        $captcha = $request->input('g-recaptcha-response');

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

            $validated['company_id'] = $id;

            if(!$message = Message::create($validated)->fresh() )
            {
                Throw new \Exception('Failed to create message.');
            }


            DB::commit();

            Mail::to($company->user->email)->queue(new CompanyMessage($message));

            if(!Mail::failures())
            {
                return back()->with('success','Thank for you contacting '.$company->title.', we have forwarded your request');
            }

        }
        catch (\Throwable $e) {
            report($e);
            DB::rollBack();
        }

        $error = 'An error occurred, please try again, if the problem persists please contact us';
        if(isset($e)) {
            if($e->getCode() == 406)
            {
                $error = 'You failed the human validation checks';
            }
        }
        return back()->withInput()->with('error',$error);
    }


    public function viewDetailedCustomerList(Request $request)
    {
        $companies = false;

        if($request->exists('code'))
        {
            if($request->input('code') == 'CHICKENlegs@321!')
            {
                $companies = Company::with(['user'])->orderBy('title')->get();
            }
        }

        return view('detailed-customer-list', compact(['companies']));
    }
}
