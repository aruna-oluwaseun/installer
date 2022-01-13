<?php

?>
@push('styles')
    @livewireStyles
    <link href="{{ asset('libraries/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
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
                                <h2 class="heading-decorated">Account</h2>
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

            <!-- content -->
            <div class="col-lg-8 col-xl-9 section-divided__main section-divided__main-left">

                <ul class="nav nav-tabs mb-5" id="navTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#details" id="details-tab" data-toggle="tab" role="tab">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" id="about-tab" data-toggle="tab" role="tab">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services" id="services-tab" data-toggle="tab" role="tab">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery" id="gallery-tab" data-toggle="tab" role="tab">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews" id="reviews-tab" data-toggle="tab" role="tab">Reviews</a>
                    </li>
                </ul>

                <div id="tabContent"><!-- begin tab content -->

                    <!-- Tab Details -->
                    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                        <form method="post" action="{{ url('company/profile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <h4 class="mb-3">Logo and Website</h4>

                            <?php if($company->avatar && \Illuminate\Support\Facades\Storage::exists($company->avatar)) : ?>
                                <hr>
                                <div class="mb-4 mt-4">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($company->avatar) }}" width="300">
                                </div>
                                <a href="{{ url('company/delete-avatar') }}" class="btn btn-danger mb-4 destroy-btn">Delete Avatar</a>

                            <?php else : ?>
                                <div class="form-group uploadMe" data-type="company[avatar]">
                                    <label>Company Avatar (Logo)</label>
                                    <input class="form-input" type="file" value="{{ old('company.avatar') }}">

                                    <div class="progress-linear mt-2" style="display: none">
                                        <div class="progress-header">
                                            <p>Upload Progress</p><span class="progress-value">0</span>
                                        </div>
                                        <div class="progress-bar-linear-wrap">
                                            <div class="progress-bar-linear"></div>
                                        </div>
                                    </div>

                                    <div class="file-inputs">

                                    </div>
                                    <p class="text-info mt-2">Max image size 5mb, For best results try and stick to and image size of 1349 x 496 pixels</p>
                                </div>
                            <?php endif; ?>

                            <?php if($company->cover_photo && \Illuminate\Support\Facades\Storage::exists($company->cover_photo)) : ?>
                                <hr>
                                <div class="mb-4 mt-4">
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($company->cover_photo) }}" width="500">
                                </div>
                                <a href="{{ url('company/delete-cover-photo') }}" class="btn btn-danger mb-4 destroy-btn">Delete Cover Photo</a>

                            <?php else : ?>
                                <div class="form-group uploadMe" data-type="company[cover_photo]">
                                    <label>Profile Cover Photo</label>
                                    <input class="form-input" type="file" value="{{ old('company.cover_photo') }}">

                                    <div class="progress-linear mt-2" style="display: none">
                                        <div class="progress-header">
                                            <p>Upload Progress</p><span class="progress-value">0</span>
                                        </div>
                                        <div class="progress-bar-linear-wrap">
                                            <div class="progress-bar-linear"></div>
                                        </div>
                                    </div>

                                    <div class="file-inputs">

                                    </div>

                                    <p class="text-info mt-2">Max image size 5mb, Preferably upload a square image</p>
                                </div>
                            <?php endif; ?>


                            <div class="form-group">
                                <label>Company Website</label>
                                <input class="form-input" type="text" name="company[website]" value="{{ old('company.website', isset($company->website) ? $company->website : '') }}">
                                <p class="text-info mt-2">Please enter the full URL for your website, e.g : https://fedca.co.uk</p>
                            </div>
                            <div class="form-group">
                                <label>Company Email</label>
                                <input class="form-input" type="text" name="company[email]" value="{{ old('company.email', isset($company->email) ? $company->email : '') }}">
                            </div>
                            <div class="form-group">
                                <label>Company Phone</label>
                                <input class="form-input" type="text" name="company[phone]" value="{{ old('company.phone', isset($company->phone) ? $company->phone : '') }}">
                            </div>
                            <div class="form-group">
                                <label>Company Mobile</label>
                                <input class="form-input" type="text" name="company[mobile]" value="{{ old('company.mobile', isset($company->mobile) ? $company->mobile : '') }}">
                            </div>

                            <h4 class="mb-3">Socials</h4>
                            <div class="form-group">
                                <label>Facebook</label>
                                <input class="form-input" type="text" name="company[facebook]" value="{{ old('company.facebook', isset($company->facebook) ? $company->facebook : '') }}">
                                <p class="text-info mt-2">Please enter the full URL for your social pages, e.g : https://facebook.com/fedcauk</p>
                            </div>
                            <div class="form-group">
                                <label>Twitter</label>
                                <input class="form-input" type="text" name="company[twitter]" value="{{ old('company.twitter', isset($company->twitter) ? $company->twitter : '') }}">
                            </div>
                            <div class="form-group">
                                <label>Instagram</label>
                                <input class="form-input" type="text" name="company[instagram]" value="{{ old('company.instagram', isset($company->instagram) ? $company->instagram : '') }}">
                            </div>
                            <div class="form-group">
                                <label>YouTube</label>
                                <input class="form-input" type="text" name="company[youtube]" value="{{ old('company.youtube', isset($company->youtube) ? $company->youtube : '') }}">
                            </div>
                            <div class="form-group">
                                <label>LinkedIn</label>
                                <input class="form-input" type="text" name="company[linkedin]" value="{{ old('company.linkedin', isset($company->linkedin) ? $company->linkedin : '') }}">
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary">Save</button>
                        </form>

                    </div>

                    <!-- Tab Gallery -->
                    <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <form method="post" action="{{ url('company/profile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h4 class="mb-3">About</h4>

                            <div class="form-group">
                                <label>information about your company</label>
                                <textarea name="company[about]" class="summernote-single form-control" placeholder="">
                                    {{ old('company.about', isset($company->about) ? $company->about : '') }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label>Add a company video</label>
                                <input class="form-input" type="text" name="company[company_video]" value="{{ old('company.company_video', isset($company->company_video) ? $company->company_video : '') }}">
                                <p class="text-info mt-2">YouTube or Vimeo link only</p>
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary">Save</button>
                        </form>
                    </div>


                    <!-- Tab Services -->
                    <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                        <form method="post" action="{{ url('company/profile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <?php
                                $services = services();

                                $ignore_services = [];
                                if($company->services->count())
                                {
                                    foreach ($company->services as $service)
                                    {
                                        $ignore_services []= $service->id; // already in portfolio
                                    }
                                }
                            ?>

                            <h4 class="mb-3">Add Service</h4>
                            <div class="alert alert-info">Add all the services you undertake so visitors are able find you better. Visitors can filter their search based on the services they require.</div>
                            <?php if( $services->count()-(count($ignore_services)) ) : ?>
                            <div class="form-group">
                                <label>Add a service to your portfolio</label>
                                <select class="form-control country" name="service[service_id]" id="add-service">
                                    <option value="">Select available services</option>
                                    <?php foreach($services as $service) : if(in_array($service->id,$ignore_services)) { continue; } ?>
                                        <option value="{{ $service->id }}" {{ is_selected($service->id, old('service.service_id')) }}>{{$service->title}}</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label>{{ $services->count()-(count($ignore_services)) ? 'OR Add a new' : 'New' }} service</label>
                                <input  class="form-input" type="text" name="service[new_service]" id="add-new-service" value="{{ old('service.new_service') }}" placeholder="Service name">
                                <p class="text-info mt-2">{{ $services->count()-(count($ignore_services)) ? 'Service not listed? add a new service here.' : 'Add a new service.' }}</p>
                            </div>

                            <div class="form-group">
                                <label>Describe your service</label>
                                <textarea name="service[description]" class="summernote-single form-control">
                                    {{ old('service.description') }}
                                </textarea>
                            </div>

                            <div class="form-group uploadMe" data-type="service[image]">
                                <label>Service Image</label>
                                <input class="form-input" type="file" value="">

                                <div class="progress-linear mt-2" style="display: none">
                                    <div class="progress-header">
                                        <p>Upload Progress</p><span class="progress-value">0</span>
                                    </div>
                                    <div class="progress-bar-linear-wrap">
                                        <div class="progress-bar-linear"></div>
                                    </div>
                                </div>

                                <div class="file-inputs">

                                </div>

                                <p class="text-info mt-2">Max image size 5mb</p>
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary">Save</button>

                            <hr class="mb-5 mt-5">
                            <h4 class="mb-3">Your Services</h4>

                            <?php if($company->services->count()) : ?>

                            <?php foreach ($company->services as $my_service) : ?>
                            @push('modals')
                                <div class="modal fade" id="editServiceModal{{$my_service->id}}" role="dialog">
                                    <div class="modal-dialog modal-dialog_custom">
                                        <!-- Modal content-->
                                        <div class="modal-dialog__inner" style="padding-top: 20px;">
                                            <button class="close" type="button" data-dismiss="modal"></button>
                                            <div class="modal-dialog__content">
                                                <h5>{{ $my_service->title }}</h5>
                                                <hr>
                                                <!-- RD Mailform-->
                                                <form class="rd-mailform_responsive" method="post" action="{{ url('company/service/'.$my_service->id) }}" novalidate="novalidate">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group mt-4">
                                                        <label>Describe your service</label>
                                                        <textarea name="description" class="summernote-single form-control" placeholder="Something about your service">
                                                            {{ $my_service->pivot->description }}
                                                        </textarea>
                                                    </div>

                                                    <?php if($my_service->pivot->image && \Illuminate\Support\Facades\Storage::exists($my_service->pivot->image)) : ?>
                                                    <hr>
                                                    <div class="mb-4 mt-4">
                                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($my_service->pivot->image) }}" width="200">
                                                    </div>
                                                    <a href="{{ url('company/delete-service-photo/'.$my_service->id) }}" class="btn btn-sm btn-danger mb-4 destroy-btn">Delete Image</a><br>

                                                    <?php else : ?>
                                                    <div class="form-group uploadMe" data-type="image">
                                                        <label>Profile Cover Photo</label>
                                                        <input class="form-input" name="image" type="file" value="">

                                                        <div class="progress-linear mt-2" style="display: none">
                                                            <div class="progress-header">
                                                                <p>Upload Progress</p><span class="progress-value">0</span>
                                                            </div>
                                                            <div class="progress-bar-linear-wrap">
                                                                <div class="progress-bar-linear"></div>
                                                            </div>
                                                        </div>

                                                        <div class="file-inputs">

                                                        </div>

                                                        <p class="text-info mt-2">Max image size 5mb, Preferably upload a square image</p>
                                                    </div>
                                                    <?php endif; ?>

                                                    <button class="button button-primary" type="submit">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endpush

                            <div class="card mb-3 grey-border">
                                <div class="card-header"><h4 class="text-primary">{{ $my_service->title }}</h4></div>
                                <div class="card-body">
                                    <div class="row mt-1">
                                        <div class="col-sm-2">
                                            <?php if($my_service->pivot->image && \Illuminate\Support\Facades\Storage::exists($my_service->pivot->image)) : ?>
                                            <div class="mb-4 mt-4">
                                                <img src="{{ \Illuminate\Support\Facades\Storage::url($my_service->pivot->image) }}" width="200">
                                            </div>
                                            <a href="{{ url('company/delete-service-photo/'.$my_service->id) }}" class="btn btn-sm btn-danger mb-4 destroy-btn">Delete Image</a><br>
                                            <?php else : ?>
                                                <img src="{{  asset('img/default-service.jpg') }}" width="200" alt="No photo">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-10">
                                            <p>{!! isset($my_service->pivot->description) ? \Illuminate\Support\Str::words($my_service->pivot->description, 20) : 'No description left' !!}</p>

                                        </div>
                                    </div>
                                 </div>
                                <div class="card-footer bg-white">
                                    <a href="#editServiceModal{{$my_service->id}}" data-toggle="modal" data-dismiss="modal" class="btn btn-sm btn-outline-success">Edit Service</a>
                                    <a href="{{ url('company/delete-service/'.$my_service->id) }}" class="btn btn-sm btn-outline-danger destroy-btn">Remove Service</a>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <?php else : ?>

                            <div class="alert alert-warning">You have not added any services to your portfolio.</div>

                            <?php endif; ?>
                        </form>

                    </div>

                    <!-- Tab Gallery -->
                    <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">

                        @livewire('gallery', ['company_id' => $company->id])

                    </div>

                    <!-- Tab Reviews -->
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                        <a href="#shareReviewModal" data-toggle="modal" class="button button-primary mt-3 mt-md-0">Share Review link</a>

                        <form method="post" action="{{ url('company/profile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <?php
                                $active_reviews = $company->reviews()->active();
                                $pending_reviews = $company->reviews()->whereNotNull('pending_until')->pending();
                                $contested_reviews = $company->reviews()->contested();
                            ?>


                            <?php if($company->reviews->count()) : ?>

                            <p class="mb-1">Total active reviews <strong>{{ $active_reviews->count() }}</strong> / Total pending <strong>{{ $pending_reviews->count() }}</strong> / Total contested <strong>{{ $contested_reviews->count() }}</strong></p>

                            <ul class="nav nav-pills review-pills mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#approved-reviews">Approved</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pending-reviews">Pending Action</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#contested-reviews">Contested</a>
                                </li>
                            </ul>
                            <ul id="approved-reviews" class="list-group review-groups mt-1">
                                <?php foreach ($active_reviews->get() as $review) : $rating = round($review->rating*2) / 2; ?>
                                <li class="list-group-item">
                                    <h6>
                                        {{ $review->title }}

                                        <?php if($review->verified) : ?>
                                        <a href="#" ><span data-toggle="tooltip" data-placement="top" title="Verified Review"><img src="{{ asset('img/icon-verified.png') }}" width="16" alt="" ></span></a>
                                        <?php else :  ?>
                                        <a href="#" ><span data-toggle="tooltip" data-placement="top" title="Not Verified"><img src="{{ asset('img/icon-not-verified.png') }}" width="16" alt="" ></span></a>
                                        <?php endif; ?>

                                        <div class="mt-3 mt-md-0 float-md-right">
                                            <fieldset class="rate small">
                                                <input type="radio" id="first-rating10" value="10" disabled {{ is_checked(10, ($rating*2)) }} /><label for="first-rating10" title="5 stars"></label>
                                                <input type="radio" id="first-rating9" value="9" disabled {{ is_checked(9, ($rating*2)) }} /><label class="half" for="first-rating9" title="4 1/2 stars"></label>
                                                <input type="radio" id="first-rating8" value="8" disabled {{ is_checked(8, ($rating*2)) }} /><label for="first-rating8" title="4 stars"></label>
                                                <input type="radio" id="first-rating7" value="7" disabled {{ is_checked(7, ($rating*2)) }} /><label class="half" for="first-rating7" title="3 1/2 stars"></label>
                                                <input type="radio" id="first-rating6" value="6" disabled {{ is_checked(6, ($rating*2)) }} /><label for="first-rating6" title="3 stars"></label>
                                                <input type="radio" id="first-rating5" value="5" disabled {{ is_checked(5, ($rating*2)) }} /><label class="half" for="first-rating5" title="2 1/2 stars"></label>
                                                <input type="radio" id="first-rating4" value="4" disabled {{ is_checked(4, ($rating*2)) }} /><label for="first-rating4" title="2 stars"></label>
                                                <input type="radio" id="first-rating3" value="3" disabled {{ is_checked(3, ($rating*2)) }} /><label class="half" for="first-rating3" title="1 1/2 stars"></label>
                                                <input type="radio" id="first-rating2" value="2" disabled {{ is_checked(2, ($rating*2)) }} /><label for="first-rating2" title="1 star"></label>
                                                <input type="radio" id="first-rating1" value="1" disabled {{ is_checked(1, ($rating*2)) }} /><label class="half" for="first-rating1" title="1/2 star"></label>
                                                <a href="#" class="text-white view-reviews" style="font-size: 13px; padding-top: 10px; padding-right:7px">({{$company->reviews->count()}})</a>
                                            </fieldset>
                                        </div>
                                    </h6>
                                    <p>{{ $review->description }}</p>
                                    <p class="mt-2 text-muted">Reviewed by <span style="font-style: italic;">{{ $review->first_name.' '.$review->last_name }}</span> on {{ short_date_time($review->created_at) }}</p>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                            <ul id="pending-reviews" class="list-group review-groups mt-1" style="display: none">
                                <?php foreach ($pending_reviews->get() as $review) : if($review->pending_unitl >= date('Y-m-d')) { continue; } $rating = round($review->rating*2) / 2; ?>

                                <li class="list-group-item" id="pending-review-{{$review->id}}">
                                    <h6>
                                        {{ $review->title }}

                                        <?php if($review->verified) : ?>
                                        <a href="#" ><span data-toggle="tooltip" data-placement="top" title="Verified Review"><img src="{{ asset('img/icon-verified.png') }}" width="16" alt="" ></span></a>
                                        <?php else :  ?>
                                        <a href="#" ><span data-toggle="tooltip" data-placement="top" title="Not Verified"><img src="{{ asset('img/icon-not-verified.png') }}" width="16" alt="" ></span></a>
                                        <?php endif; ?>

                                        <div class="mt-3 mt-md-0 float-md-right">
                                            <fieldset class="rate small">
                                                <input type="radio" id="first-rating10" value="10" disabled {{ is_checked(10, ($rating*2)) }} /><label for="first-rating10" title="5 stars"></label>
                                                <input type="radio" id="first-rating9" value="9" disabled {{ is_checked(9, ($rating*2)) }} /><label class="half" for="first-rating9" title="4 1/2 stars"></label>
                                                <input type="radio" id="first-rating8" value="8" disabled {{ is_checked(8, ($rating*2)) }} /><label for="first-rating8" title="4 stars"></label>
                                                <input type="radio" id="first-rating7" value="7" disabled {{ is_checked(7, ($rating*2)) }} /><label class="half" for="first-rating7" title="3 1/2 stars"></label>
                                                <input type="radio" id="first-rating6" value="6" disabled {{ is_checked(6, ($rating*2)) }} /><label for="first-rating6" title="3 stars"></label>
                                                <input type="radio" id="first-rating5" value="5" disabled {{ is_checked(5, ($rating*2)) }} /><label class="half" for="first-rating5" title="2 1/2 stars"></label>
                                                <input type="radio" id="first-rating4" value="4" disabled {{ is_checked(4, ($rating*2)) }} /><label for="first-rating4" title="2 stars"></label>
                                                <input type="radio" id="first-rating3" value="3" disabled {{ is_checked(3, ($rating*2)) }} /><label class="half" for="first-rating3" title="1 1/2 stars"></label>
                                                <input type="radio" id="first-rating2" value="2" disabled {{ is_checked(2, ($rating*2)) }} /><label for="first-rating2" title="1 star"></label>
                                                <input type="radio" id="first-rating1" value="1" disabled {{ is_checked(1, ($rating*2)) }} /><label class="half" for="first-rating1" title="1/2 star"></label>
                                                <a href="#" class="text-white view-reviews" style="font-size: 13px; padding-top: 10px; padding-right:7px">({{$company->reviews->count()}})</a>
                                            </fieldset>
                                        </div>
                                    </h6>
                                    <p>{{ $review->description }}</p>
                                    <p class="mt-2 text-muted">Reviewed by <span style="font-style: italic;">{{ $review->first_name.' '.$review->last_name }}</span> on {{ short_date_time($review->created_at) }}</p>

                                    <div class="alert alert-info">
                                        If you are happy for this review to be on your profile you do not need to do anything, it will automatically be posted on {{ short_date($review->pending_until) }}
                                    </div>

                                    <p>
                                        <a id="contest-btn-{{$review->id}}" href="#contestReviewModal" data-review-id="{{ $review->id }}" data-toggle="modal" data-dismiss="modal" class="button button-primary">Contest Review</a>
                                    </p>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                            <ul id="contested-reviews" class="list-group review-groups mt-1" style="display: none">
                                <?php foreach ($contested_reviews->get() as $review) : $rating = round($review->rating*2) / 2; ?>
                                <li class="list-group-item">
                                    <h6>
                                        {{ $review->title }}

                                        <?php if($review->verified) : ?>
                                        <a href="#" ><span data-toggle="tooltip" data-placement="top" title="Verified Review"><img src="{{ asset('img/icon-verified.png') }}" width="16" alt="" ></span></a>
                                        <?php else :  ?>
                                        <a href="#" ><span data-toggle="tooltip" data-placement="top" title="Not Verified"><img src="{{ asset('img/icon-not-verified.png') }}" width="16" alt="" ></span></a>
                                        <?php endif; ?>

                                        <div class="mt-3 mt-md-0 float-md-right">
                                            <fieldset class="rate small">
                                                <input type="radio" id="first-rating10" value="10" disabled {{ is_checked(10, ($rating*2)) }} /><label for="first-rating10" title="5 stars"></label>
                                                <input type="radio" id="first-rating9" value="9" disabled {{ is_checked(9, ($rating*2)) }} /><label class="half" for="first-rating9" title="4 1/2 stars"></label>
                                                <input type="radio" id="first-rating8" value="8" disabled {{ is_checked(8, ($rating*2)) }} /><label for="first-rating8" title="4 stars"></label>
                                                <input type="radio" id="first-rating7" value="7" disabled {{ is_checked(7, ($rating*2)) }} /><label class="half" for="first-rating7" title="3 1/2 stars"></label>
                                                <input type="radio" id="first-rating6" value="6" disabled {{ is_checked(6, ($rating*2)) }} /><label for="first-rating6" title="3 stars"></label>
                                                <input type="radio" id="first-rating5" value="5" disabled {{ is_checked(5, ($rating*2)) }} /><label class="half" for="first-rating5" title="2 1/2 stars"></label>
                                                <input type="radio" id="first-rating4" value="4" disabled {{ is_checked(4, ($rating*2)) }} /><label for="first-rating4" title="2 stars"></label>
                                                <input type="radio" id="first-rating3" value="3" disabled {{ is_checked(3, ($rating*2)) }} /><label class="half" for="first-rating3" title="1 1/2 stars"></label>
                                                <input type="radio" id="first-rating2" value="2" disabled {{ is_checked(2, ($rating*2)) }} /><label for="first-rating2" title="1 star"></label>
                                                <input type="radio" id="first-rating1" value="1" disabled {{ is_checked(1, ($rating*2)) }} /><label class="half" for="first-rating1" title="1/2 star"></label>
                                                <a href="#" class="text-white view-reviews" style="font-size: 13px; padding-top: 10px; padding-right:7px">({{$company->reviews->count()}})</a>
                                            </fieldset>
                                        </div>
                                    </h6>
                                    <p>{{ $review->description }}</p>
                                    <p class="mt-2 text-muted">Reviewed by <span style="font-style: italic;">{{ $review->first_name.' '.$review->last_name }}</span> on {{ short_date_time($review->created_at) }}</p>
                                    <hr>
                                    <p class="mt-3 p-3 alert-warning">Your contested reason : {{ $review->contest_reason }}</p>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                            <?php else : ?>

                            <div class="alert alert-warning mt-3">No reviews have been posted to your profile.</div>

                            <?php endif; ?>
                        </form>

                    </div>
                </div><!-- end tab content -->


            </div>

            <!-- sidemenu -->
            <div class="col-lg-4 col-xl-3 section-divided__aside section__aside-left">
                {{ view('account.templates.side-menu') }}
            </div>
        </div>
    </div>
</section>

@stack('modals')

<div class="modal fade" id="contestReviewModal" role="dialog">
    <div class="modal-dialog modal-dialog_custom">
        <!-- Modal content-->
        <div class="modal-dialog__inner" style="padding-top: 20px;">
            <button class="close" type="button" data-dismiss="modal"></button>
            <div class="modal-dialog__content">
                @livewire('contest-review')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="shareReviewModal" role="dialog">
    <div class="modal-dialog modal-dialog_custom">
        <!-- Modal content-->
        <div class="modal-dialog__inner" style="padding-top: 20px;">
            <button class="close" type="button" data-dismiss="modal"></button>
            <div class="modal-dialog__content">
                <h5>Share a review link</h5>
                <hr>

                <form method="post" action="{{ url('company/share-review-link') }}">
                    @csrf

                    <div class="form-group mt-3 mb-2">
                        <label>Enter name *</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>

                    <div class="form-group mb-2">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" class="form-input" rows="10" placeholder="Optional message to send with the review link"></textarea>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="button button-primary mt-0">
                            Send review link
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadMediaModal" role="dialog">
    <div class="modal-dialog modal-dialog_custom">
        <!-- Modal content-->
        <div class="modal-dialog__inner" style="padding-top: 20px;">
            <button class="close" type="button" data-dismiss="modal"></button>
            <div class="modal-dialog__content">
                <h5>Add Photos to :  <span></span></h5>
                <hr>

                <div class="nk-upload-form mt-3">
                    <form action="{{ url('upload-media') }}" method="POST" enctype="multipart/form-data" id="" class="upload-zone small bg-lighter">
                        @csrf

                        <div class="dz-message" data-dz-message>
                            <span class="dz-message-text"><span>Drag and drop</span> file here or <span>browse</span></span>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('libraries/summernote.js') }}"></script>
    <script src="{{ asset('libraries/dropzone/dropzone.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    @livewireScripts
@endpush
{{ view('templates/footer') }}

<script type="text/javascript">

    $('#contestReviewModal').on('shown.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var review_id = button.data('review-id');

        Livewire.emit('set:review',review_id);
    });

    $('#uploadMediaModal').on('shown.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var gallery_id = button.data('gallery-id');
        var gallery_title = button.data('gallery-title');

        $('#uploadMediaModal h5 span').text(gallery_title);

        addDropzone(gallery_id);
    });

    window.addEventListener('review-contested', event => {

        Swal.fire({
            icon: 'success',
            title: 'Review Contested ',
            text: 'We will reach out to the reviewer to resolve this query and follow up with you accordingly',
            //footer: '<a href>Why do I have this issue?</a>'
        });

        if(event.detail.reviewId)
        {
            $('#contestReviewModal').modal('hide');

            var review = $('#pending-review-' + event.detail.reviewId);
            $(review).find('.alert.alert-info').remove();
            $(review).find('.button-primary').remove();
            var copy = $(review).html();

            $('#contested-reviews').prepend('<li class="list-group-item">' + copy + '</li>');
            review.hide();
        }
    })

    if($(location).attr('hash').length)  {
        var hash = $(location).attr('hash');
        var parent = $('a[href="'+ hash +'"]').parents('.section-divided__main');

        if(hash.search('reviews') > -1)
        {
            setTimeout(function(){
                $('#reviews-tab').click();
            }, 500);
        }
    }

    $('.review-pills .nav-link').on('click', function(e) {
        e.preventDefault();
        var tab = $(this).attr('href');

        $('.review-pills .nav-link').removeClass('active');
        $(this).addClass('active');

        $('.review-groups').hide();
        $(tab).show();
    });

    $('.uploadMe input[type=file]').on('change',function(e) {

        var ext = $(this).val().split(".");
        ext = ext[ext.length-1].toLowerCase();
        var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid file type',
                text: 'Please select images only ' + ext + ' is not supported.',
                //footer: '<a href>Why do I have this issue?</a>'
            });
            $(this).val("");
            return;
        }

        var parent = $(this).parents('.uploadMe');
        var field = parent.data('type');
        var myFile = $(this).prop('files')[0];
        var progress_container = parent.find('.progress-linear');
        var progress_text = parent.find('.progress-value');
        var progress_display = parent.find('.progress-bar-linear');

        progress_container.show();
        progress_display.removeClass('success');
        progress_text.text(0);
        progress_display.css('width','0%');

        //debug(myFile);
        Vapor.store(myFile, {
            visibility: 'public-read',
            progress: progress => {
                const percentage = Math.round(progress * 100);
                progress_text.text(percentage);
                progress_display.css('width',percentage + '%');
            }
        }).then(response => {

            parent.find('.file-inputs').html(
                '<input type="hidden" name="'+ field +'[uuid]" value="' + response.uuid + '">'+
                '<input type="hidden" name="'+ field +'[key]" value="' + response.key + '">' +
                //'<input type="hidden" name="'+ field +'[bucket]" value="' + response.bucket + '">' +
                '<input type="hidden" name="'+ field +'[name]" value="' + myFile.name + '">' +
                '<input type="hidden" name="'+ field +'[content_type]" value="' + myFile.type + '">'
            );

            progress_display.addClass('success');

            setTimeout(function() {
                progress_container.hide();
            },1000);

            /*axios.post(uploadUrl, {
                uuid: response.uuid,
                key: response.key,
                bucket: response.bucket,
                name: myFile.name,
                content_type: myFile.type,
            })*/

        });
    });

    let dropzoneForm = null;
    function addDropzone(gallery_id)
    {
        if (dropzoneForm) {
            dropzoneForm.destroy();
        }


        dropzoneForm = new Dropzone('.upload-zone', {acceptedFiles: 'image/*',maxFilesize: 10});
        Dropzone.prototype.uploadFiles = async files => files.forEach(uploadFile);

        var url = dropzoneForm.element.action + '/'+gallery_id;

        dropzoneForm.on('success', function(file, response) {
            if(response.success)
            {
                /**
                 * @TODO implement this so we dont need to refresh
                 */
                // add file to DOM so we dont use reload
                console.log('File uploaded');
            }
        });
        dropzoneForm.on('queuecomplete', function(response) {
            console.log('queue complete debug')
            debug(response);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Files uploaded.',
                //footer: '<a href>Why do I have this issue?</a>'
            });

            /**
             * @TODO remove when we implement the success event
             */
            /*setTimeout(function() {
                location.reload();
            }, 2000)*/

        });
        dropzoneForm.on('error', function (file,error, XHR){
            if (!file.accepted) {
                this.removeFile(file);
                if(file.size > this.options.maxFilesize * 1024 * 1024)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'File too big',
                        text: 'You have exceeded the max upload limit of ' + this.options.maxFilesize + 'mb',
                    })
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'File type not accepted',
                        text: 'You have tried adding a file type that is not accepted.',
                    })
                }

            }
            if(XHR.status === 419)
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Token expired, please refresh and try again.',
                });
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error,
                });
            }
        });

        async function uploadFile(file) {

            const s3response = await Vapor.store(file, {
                progress: progress => {
                    const percentage = Math.round(progress * 100 * 0.9);
                    dropzoneForm.emit("uploadprogress", file, percentage);
                }
            });

            const itemResponse = await axios.post(url, {
                filename: file.name,
                filetype: file.type,
                tmp: s3response.key
            });

            if(itemResponse)
            {
                if(itemResponse.success)
                {
                    file.status = Dropzone.SUCCESS;
                }
                else
                {
                    file.status = Dropzone.ERROR;
                }

            }

            Livewire.emit('refreshGallery')
            dropzoneForm.emit("uploadprogress", file, 100);
            dropzoneForm.emit("complete", file);
            dropzoneForm.processQueue();
        }
    }


</script>
