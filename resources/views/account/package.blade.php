<?php

?>
@push('styles')

@endpush
{{ view('templates/header') }}


<section class="text-center">
    <section class="section parallax-container" data-parallax-img="{{ asset('img/stonewrap-parallax.jpg') }}"><div class="material-parallax parallax"><img src="{{ asset('img/stonewrap-parallax.jpg') }}" alt="" style="display: block; transform: translate3d(-50%, 160px, 0px);"></div>
        <div class="parallax-content parallax-header parallax-light">
            <div class="parallax-header__inner">
                <div class="parallax-header__content">
                    <div class="container">
                        <div class="row justify-content-sm-center">
                            <div class="col-md-10 col-xl-8">
                                <h2 class="heading-decorated">Next Steps</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

{{ view('account.templates.account-message') }}

<section class="section section-lg bg-default">
    <div class="container">

        {{ view('templates/alert') }}

        <div class="row row-70 flex-lg-row-reverse">

            <!-- conent -->
            <div class="col-lg-7 col-xl-8 section-divided__main section-divided__main-left">

                <h4 class="mb-3">
                   Current package <span class="text-primary">{{ $plan->name }}</span>
                    <!--<a href="#" data-toggle="modal" data-dismiss="modal" class="button button-primary mt-3 mt-md-0  float-md-right">Change plan</a>-->
                </h4>
                <h5 class="mt-3">You are billed <span class="text-primary">{{ $plan->billing_period ?: 'NA' }}</span>  @ £{{ $plan->cost ? number_format($plan->cost,2,'.',',') : 'NA'}}</h5>

                <p class="mt-2">Lets make sure you have everything setup so you start getting noticed.</p>

                <div class="card card-bordered mb-3">
                    <div class="card-header">
                        Business account details
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Make sure you account details are upto date.</p>
                        <ul class="list-marked">
                            <li>Company name </li><!-- style="text-decoration: line-through" <span class="text-success far fa-check-circle-o"></span>-->
                            <li>Accounts phone number</li>
                            <li>Company registration number</li>
                            <li>Vat number</li>
                            <li>Company address</li>
                        </ul>

                        <a href="{{ url('account') }}" target="_blank" class="button button-primary">Update</a>
                    </div>
                </div>

                <div class="card card-bordered mb-3">
                    <div class="card-header">
                        Company profile
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Jazz your profile up with your company logo, cover photo and website links.</p>
                        <ul class="list-marked">
                            <li>Logo</li>
                            <li>Cover Photo</li>
                            <li>Company website</li>
                            <li>Company email</li>
                            <li>Company phone</li>
                            <li>Company mobile</li>
                            <li>Facebook</li>
                            <li>Instagram</li>
                            <li>Youtube</li>
                            <li>Linked in</li>
                        </ul>

                        <a href="{{ url('company/profile') }}" target="_blank" class="button button-primary">Update</a>
                    </div>
                </div>

                <div class="card card-bordered mb-3">
                    <div class="card-header">
                        Company About
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Add some information about your company, you can also add a video to your profile.</p>
                        <ul class="list-marked">
                            <li>Company About</li>
                            <li>Company video (Youtube or Vimeo)</li>
                        </ul>

                        <a href="{{ url('company/profile#about') }}" target="_blank" class="button button-primary">Update</a>
                    </div>
                </div>

                <div class="card card-bordered mb-3">
                    <div class="card-header">
                        Services
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Select from a list of available services and link to them to your profile and some details for each of your services and a photo to really stand out.</p>
                        <ul class="list-marked">
                            <li>Add a service</li>
                            <li>Provide information on the service</li>
                            <li>Add a photo to a service</li>
                        </ul>

                        <a href="{{ url('company/profile#services') }}" target="_blank" class="button button-primary">Update</a>
                    </div>
                </div>

                <div class="card card-bordered mb-3">
                    <div class="card-header">
                        Gallery
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Add a gallery to your profile. Please make sure all the photos you upload are your photos.</p>
                        <ul class="list-marked">
                            <li>Upload a photo</li>
                        </ul>

                        <a href="{{ url('company/profile#gallery') }}" target="_blank" class="button button-primary">Update</a>
                    </div>
                </div>

            </div>

            <!-- sidemenu -->
            <div class="col-lg-5 col-xl-4 section-divided__aside section__aside-left">
                {{ view('account.templates.side-menu') }}
            </div>
        </div>
    </div>
</section>

{{--<div class="modal fade" id="addPaymentMethod" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog_custom">
        <!-- Modal content-->
        <div class="modal-dialog__inner" style="padding-top: 20px;">
            <button class="close" type="button" data-dismiss="modal"></button>
            <div class="modal-dialog__content">
                <h5>Add new payment method</h5>
                <hr>
                <!-- RD Mailform-->
                <form id="payment-form" class="rd-mailform_responsive" method="post" action="{{ url('account/payment-method') }}" novalidate="novalidate">
                    @csrf
                    <div class="stripe-response">
                        <!-- stripe card here -->
                    </div>

                    <div class="form-wrap">
                        <label>Card Holder Name</label>
                        <input id="card-holder-name" class="form-input" type="text">
                    </div>


                    <!-- Stripe Elements Placeholder -->
                    <div class="mt-3">
                        <div id="card-element"></div>
                    </div>

                    <div class="mt-5">
                        <button type="button" class="button button-primary mt-0" id="card-button" data-secret="{{ isset($intent) ? $intent->client_secret : '' }}">
                            Save
                        </button>
                        <div class="float-right">
                            <img src="{{ asset('img/card-icons/Powered by Stripe - black.png') }}" alt="Payments are securely powered by Stripe" width="120">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>--}}

@push('scripts')

@endpush
{{ view('templates/footer') }}


