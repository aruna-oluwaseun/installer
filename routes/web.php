<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ADD TAGS TO SERVICES

// Register
Route::get('register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('register',[\App\Http\Controllers\AuthController::class,'store']);

Route::get('login',[\App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::post('login',[\App\Http\Controllers\AuthController::class,'authenticate']);
Route::get('admin',[\App\Http\Controllers\AuthController::class,'admin']);


Route::get('/forgot-password', [\App\Http\Controllers\AuthController::class,'forgotPassword'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\AuthController::class,'sendResetLink'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [\App\Http\Controllers\AuthController::class,'resetPassword'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\AuthController::class,'confirmResetPassword'])->middleware('guest')->name('password.update');

// Vapor override
Route::post('/vapor/signed-storage-url',[\App\Http\Controllers\GuestSignedStorageController::class,'store'])
    ->middleware(config('vapor.middleware', 'web'));

// Auth views
Route::middleware('auth')->group(function() {

    // Delete Account Method Here
    /** @TODO */

    // Signout
    Route::get('sign-out',[\App\Http\Controllers\AuthController::class,'signout']);

    // Upload
    Route::post('upload',[\App\Http\Controllers\SearchController::class,'store']);

    // Account
    Route::get('account', [\App\Http\Controllers\UserController::class,'index']);
    Route::post('account', [\App\Http\Controllers\UserController::class,'update']);
    Route::get('account/payment-method',[\App\Http\Controllers\UserController::class,'paymentMethod']);
    Route::post('account/payment-method',[\App\Http\Controllers\UserController::class,'storePaymentMethod']);
    Route::get('account/payment-method',[\App\Http\Controllers\UserController::class,'paymentMethod']);
    Route::get('account/package', [\App\Http\Controllers\UserController::class,'package']);
    Route::get('account/settings', [\App\Http\Controllers\UserController::class,'settings']);
    Route::get('account/notifications', [\App\Http\Controllers\UserController::class,'notifications']);
    Route::get('account/verify',[\App\Http\Controllers\UserController::class,'getVerified']);

    // Livewire
    Route::get('contest-review',\App\Http\Livewire\ContestReview::class);
    Route::put('contest-review',\App\Http\Livewire\ContestReview::class);
    Route::get('gallery',\App\Http\Livewire\Gallery::class);
    Route::put('gallery',\App\Http\Livewire\Gallery::class);
    Route::put('delete-image',[\App\Http\Livewire\Gallery::class,'deleteImage']);

    Route::post('upload-media/{gallery_id}',[\App\Http\Controllers\MediaController::class,'store']);

    Route::get('package/subscribe/{id}/{title?}', [\App\Http\Controllers\UserController::class,'subscribe'])->name('subscribe');
    Route::post('package/subscribe/{id}/{title?}', [\App\Http\Controllers\UserController::class,'storeSubscription']);



    // Company
    Route::get('company/profile', [\App\Http\Controllers\CompanyController::class,'edit']);
    Route::put('company/profile', [\App\Http\Controllers\CompanyController::class,'update']);
    Route::get('company/delete-avatar',[\App\Http\Controllers\CompanyController::class,'deleteAvatar']);
    Route::get('company/delete-cover-photo',[\App\Http\Controllers\CompanyController::class,'deleteCoverPhoto']);
    Route::get('company/delete-service/{id}',[\App\Http\Controllers\CompanyController::class,'deleteService']);
    Route::put('company/service/{id}',[\App\Http\Controllers\CompanyController::class,'updateService']);
    Route::put('company/delete-service-photo/{id}',[\App\Http\Controllers\CompanyController::class,'deleteServicePhoto']);
    Route::post('company/share-review-link',[\App\Http\Controllers\ReviewController::class,'shareReviewLink']);

    Route::get('company/get-verified',[\App\Http\Controllers\CompanyLiabilityController::class,'getVerified'])->name('verify');
    Route::post('company/get-verified',[\App\Http\Controllers\CompanyLiabilityController::class,'store'])->name('verify.do');

    // Allow Companies to manage jobs / upload job spec etc.


    // Allow customers to

    // Notifications
    Route::get('manage-notifications',function (){
       return 'Notification settings here';
    });

});

// View list of companies
Route::match(['get','post'],'companies-list',[\App\Http\Controllers\CompanyController::class,'viewDetailedCustomerList']);

// Business Public page
Route::get('business/{id}/{name?}', [\App\Http\Controllers\CompanyController::class,'index'])->name('business_profile');
Route::get('detail/{id}/{name?}', [\App\Http\Controllers\BlogController::class,'detail'])->name('details');
Route::post('message/business/{id}',[\App\Http\Controllers\CompanyController::class, 'contact']);

// Record hits
Route::get('record-stat', [\App\Http\Controllers\HomeController::class,'recordStat']);

// Find an installer
Route::get('find-installer',[\App\Http\Controllers\SearchController::class,'index']);

// Find an installer
Route::get('blog',[\App\Http\Controllers\BlogController::class,'index']);


// Home
Route::get('/', [\App\Http\Controllers\HomeController::class,'index']);

// Packages
Route::get('packages',[\App\Http\Controllers\HomeController::class,'packages']);

// Benefits
Route::get('benefits',[\App\Http\Controllers\HomeController::class,'benefits']);

// About
Route::get('about',[\App\Http\Controllers\HomeController::class,'about']);

// Contact
Route::get('contact', [\App\Http\Controllers\HomeController::class,'contact']);
Route::post('contact', [\App\Http\Controllers\HomeController::class,'storeContact']);

Route::get('how-it-works',[\App\Http\Controllers\HomeController::class,'howItWorks']);

Route::get('verified-company',[\App\Http\Controllers\HomeController::class,'verifiedCompany']);

Route::get('action-company-verification/{id}', [\App\Http\Controllers\CompanyLiabilityController::class, 'verify']);
Route::put('action-company-verification/{id}', [\App\Http\Controllers\CompanyLiabilityController::class,'actionVerify']);
Route::match(['get','delete'],'action-company-verification/delete-reference/{id}', [\App\Http\Controllers\CompanyLiabilityController::class,'destroyReference']);

Route::get('terms-and-conditions',[\App\Http\Controllers\HomeController::class,'terms'])->name('terms');

Route::get('code-of-conduct',[\App\Http\Controllers\HomeController::class,'codeOfConduct'])->name('conduct');

Route::get('terms-of-subscription',[\App\Http\Controllers\HomeController::class,'termsOfSale'])->name('terms-of-sale');

Route::get('privacy-policy',[\App\Http\Controllers\HomeController::class,'privacyPolicy'])->name('privacy');


Route::get('cookie-policy',[\App\Http\Controllers\HomeController::class,'cookiePolicy'])->name('cookie');

Route::get('standards',[\App\Http\Controllers\HomeController::class,'standards'])->name('standards');

//-----

Route::post('leave-review',[\App\Http\Controllers\ReviewController::class,'store']);
Route::get('action-review/{id}', [\App\Http\Controllers\ReviewController::class, 'index']);
Route::put('action-review/{id}', [\App\Http\Controllers\ReviewController::class,'update']);


Route::get('unsubscribe', [\App\Http\Controllers\HomeController::class,'unsubscribe']);

/**
 * Fetch postcode
 */
Route::match(['get','post'],'fetch-postcode',[\App\Http\Controllers\HomeController::class,'getPostcode']);

Route::get('testing', function() {
    /*$user = \App\Models\User::with(['company' => function($q) {
        $q->active();
    }])->orderBy('users.id','DESC')->first();

    dump($user);*/

    //dd(basename(\Illuminate\Support\Facades\Storage::path('companies/10/gallery/6/ab9fee8b-e83e-4b57-b743-08ffd40072fa.jpeg')));

    //Mail::to('test@test.com')->send(new \App\Mail\YouAreNotVisible($user));

    $today = new \DateTime('now');

    // None visible subscribers

    /*$companies = \App\Models\Company::with(['user'])->active()->get();

    if($companies->count()) {
        $less_2_weeks = new \DateTime('now');
        $less_2_weeks->modify('- 2 weeks');

        foreach ($companies as $company) {

            echo ($company->user->email).'<br>';
           //echo('The company ID ' . $user->company->id);

        }
    }*/

});
