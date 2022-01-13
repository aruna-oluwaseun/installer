<?php

    $review_posted = false;
    if(old('form_type', null) != null)
    {
        $review_posted = true;
    }

    $og_image = asset('img/og-image.jpg');
    $og_description = 'View '.$company->title.' on Fedca - The Decorative Coatings Association';

    if($company->about)
    {
        $og_description = \Illuminate\Support\Str::words($company->about, 60,'...');
    }

    $cover_photo = asset('img/default-cover-photo.jpg');
    if($company->cover_photo && \Illuminate\Support\Facades\Storage::exists($company->cover_photo))
    {
        $cover_photo = \Illuminate\Support\Facades\Storage::url($company->cover_photo);
        $og_image = $cover_photo;
    }

    $company_avatar = false;
    if($company->avatar && \Illuminate\Support\Facades\Storage::exists($company->avatar))
    {
        $company_avatar = \Illuminate\Support\Facades\Storage::url($company->avatar);
    }
?>
@push('styles')
    <meta property="og:title" content="{{ $company->title }}" />
    <meta property="og:description" content="{{ $og_description }}" />
    <meta property="og:image" content="{{ $og_image }}" />
    <meta property="og:url" content="{{ url('business/'.$company->id.'/'.slug($company->title)) }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endpush
{{ view('templates/header') }}

<div class="company-profile">
    <!-- SUB Banner -->
    <div class="profile-bnr bg-contain" style="background: url({{ $cover_photo }});">
        <div class="container">

            <!-- User Iinfo -->
            <div class="user-info">
                <h1>{{ $company->title }}
                    <?php if($company->verified) : ?>
                    <a href="{{ url('verified-company') }}" target="_blank"><span data-toggle="tooltip" data-placement="top" title="Verified Company"><img src="{{ asset('img/icon-verified.png') }}" width="16" alt="" ></span></a>
                    <?php else :  ?>
                    <a href="{{ url('verified-company') }}" target="_blank"><span data-toggle="tooltip" data-placement="top" title="Not Verified"><img src="{{ asset('img/icon-not-verified.png') }}" width="16" alt="" ></span></a>
                    <?php endif; ?>
                </h1>
                <!--<h6>Industry</h6>-->
                <?php if($company->address_data) : ?>
                <p>
                    <?php foreach ($company->address_data as $key => $line) : if(in_array($key,['gps_lat','gps_lng'])) { continue; } ?>
                        <?php if($line) : ?>
                            {{ $line }}<br>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <!--(<a href="#.">map</a> / <a href="#.">street</a>)-->
                </p>
                <?php endif; ?>

                <!-- Social Icon -->
                <div class="social-links">
                    <?php if($company->facebook) : ?>
                        <a href="{{$company->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                    <?php endif; ?>
                    <?php if($company->twitter) : ?>
                        <a href="{{$company->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a>
                    <?php endif; ?>
                    <?php if($company->instagram) : ?>
                        <a href="{{$company->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if($company->linkedin) : ?>
                        <a href="{{$company->linkedin}}" target="_blank"><i class="fa fa-linkedin"></i></a>
                    <?php endif; ?>
                    <?php if($company->youtube) : ?>
                        <a href="{{$company->youtube}}" target="_blank"><i class="fa fa-youtube"></i></a>
                    <?php endif; ?>
                </div>

                <!-- Stars -->
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <?php
                            $rating = 0;
                            $avg = 0;
                            if($company->reviews->count())
                            {
                                $rating_avg = $company->reviews()->avg('rating');
                                $rating = round($rating_avg*2) / 2;
                            }
                        ?>
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
                    {{--<li class="col-sm-6">
                        <p><i class="fa fa-bookmark-o"></i> 28 Bookmarks</p>
                    </li>--}}
                </div>

                <!-- Followers -->
                {{--<div class="followr">
                    <ul class="row">
                        <li class="col-sm-6">
                            <p>Followers <span>(31)</span></p>
                        </li>
                        <li class="col-sm-6">
                            <p>Following <span>(38)</span></p>
                        </li>
                    </ul>
                </div>--}}
            </div>

            <!-- Top Riht Button -->
            {{--<div class="right-top-bnr">
                <div class="connect"> <a href="#." data-toggle="modal" data-target="#myModal"><i class="fa fa-user-plus"></i> Connect</a> <a href="#."><i class="fa fa-share-alt"></i> Share</a>
                    <div class="bt-ns"> <a href="#."><i class="fa fa-bookmark-o"></i> </a> <a href="#."><i class="fa fa-envelope-o"></i> </a> <a href="#."><i class="fa fa-exclamation"></i> </a> </div>
                </div>
            </div>--}}
        </div>
    </div>

    <!-- Profile Company Content -->
    <div class="profile-company-content main-user" data-bg-color="f5f5f5">
        <div class="container">
            <div class="row">

                <!-- Nav Tabs -->
                <div class="col-md-12 ">
                    <ul class="nav nav-tabs mb-5">
                        <li class="nav-item">
                            <a class="nav-link {{ $review_posted ? '' : 'active' }}" href="#profile" id="profile-tab" data-toggle="tab" role="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gallery" id="gallery-tab" data-toggle="tab" role="tab">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $review_posted ? 'active' : '' }}" href="#reviews" id="reviews-tab" data-toggle="tab" role="tab">Reviews</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-12">
                    {{ view('templates/alert') }}
                </div>


                <!-- SIDE BAR -->
                <div class="col-md-4 mb-5">
                    <?php
                        $company_location = 'NA';
                        if(isset($company->address_data['city']))
                        {
                            $company_location = $company->address_data['city'];
                        }
                        if(isset($company->address_data['country']))
                        {
                            $company_location.= ', '.$company->address_data['country'];
                        }
                    ?>

                    <!-- Company Information -->
                    <div class="card grey-border mb-4">
                        <div class="card-header"><h5 class="font-weight-bold">Company Information</h5></div>
                        <div class="card-body">
                            <?php if($company_avatar) : ?>
                                <div class="sidebar-thumbnail mb-4">
                                    <img src="{{ $company_avatar }}"  width="200" alt="">
                                </div>
                            <?php endif; ?>
                            <ul style="font-size: 16px;">
                                <li><span class="font-weight-bold">Location</span> <span class="pull-right text-primary">{{ $company_location  }}</span></li>
                                <li><span class="font-weight-bold">Company Registration</span> <span class="pull-right text-primary">{{ $company->registration_number ?: 'NA' }}</span></li>
                                <li><span class="font-weight-bold">Company Vat</span> <span class="pull-right text-primary">{{ $company->vat_number ?: 'NA' }}</span></li>
                                {{--<li><span class="font-weight-bold">Operating Hours</span> <span class="pull-right text-primary">Testing</span></li>--}}
                            </ul>
                            <div class="company-profile-links mt-3">
                                <?php if($company->phone) : ?>
                                    <a class="record-click" data-type="phone" data-id="{{ $company->id }}" data-toggle="tooltip" data-placement="top" title="Call landline" href="tel:{{$company->phone}}"><span class="fa fa-phone"></span></a>
                                <?php endif; ?>
                                <?php if($company->mobile) : ?>
                                    <a class="record-click" data-type="mobile" data-id="{{ $company->id }}" data-toggle="tooltip" data-placement="top" title="Call mobile" href="tel:{{$company->mobile}}"><span class="fa fa-mobile-phone"></span></a>
                                <?php endif; ?>
                                <?php if($company->email) : ?>
                                    <a class="record-click" data-type="email" data-id="{{ $company->id }}" data-toggle="tooltip" data-placement="top" title="Email" href="mailto:{{$company->email}}"><span class="fa fa-envelope"></span></a>
                                <?php endif; ?>
                                <?php if($company->website) : ?>
                                    <a class="record-click" data-type="website" data-id="{{ $company->id }}" data-toggle="tooltip" data-placement="top" title="Visit Website" href="{{$company->website}}" target="_blank"><span class="fa fa-globe"></span></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Company Rating -->
                    {{--<div class="card grey-border mb-4">
                        <div class="card-header"><h5 class="font-weight-bold">Company Rating</h5></div>
                        <div class="card-body">
                            <ul class="single-category com-rate">
                                <li class="row">
                                    <h6 class="title col-xs-6">Expertise:</h6>
                                    <span class="col-xs-6"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></span> </li>
                                <li class="row">
                                    <h6 class="title col-xs-6">Knowledge:</h6>
                                    <span class="col-xs-6"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-half-o"></i> <i class="fa fa-star-o"></i></span> </li>
                                <li class="row">
                                    <h6 class="title col-xs-6">Quality::</h6>
                                    <span class="col-xs-6"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i></span> </li>
                                <li class="row">
                                    <h6 class="title col-xs-6">Price:</h6>
                                    <span class="col-xs-6"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></span> </li>
                                <li class="row">
                                    <h6 class="title col-xs-6">Services:</h6>
                                    <span class="col-xs-6"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i></span> </li>
                            </ul>
                        </div>
                    </div>--}}

                    <!-- Company Rating -->
                    <div class="card grey-border">
                        <div class="card-header"><h5 class="font-weight-bold">Contact</h5></div>
                        <div class="card-body">

                            <form method="post" action="{{ url('message/business/'. $company->id) }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-input" placeholder="Full name" name="full_name" value="{{ old('full_name') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-input" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-input" placeholder="Phone" name="phone" value="{{ old('phone') }}" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-input" placeholder="Your Enquiry" name="message" required>{{ old('message') }}</textarea>
                                </div>

                                <div class="g-recaptcha mb-3" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}"></div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="col-md-8 mb-5">
                    <div class="tab-content">

                        <!-- PROFILE -->
                        <div id="profile" class="tab-pane {{ $review_posted ? 'fade' : 'active' }}">
                            <div class="card grey-border mb-4">
                                <div class="card-header"><h5 class="font-weight-bold">About the Company</h5></div>
                                <div class="card-body">
                                     {!! $company->about !!}

                                    <!-- Video -->
                                     <?php if($company->company_video) : ?>
                                        {!! embed_video($company->company_video) !!}
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Services -->
                            <div class="card grey-border">
                                <div class="card-header"><h5 class="font-weight-bold">Services</h5></div>
                                <div class="profile-in profile-serv">
                                    <h6 class="mt-3">Here’s an overview of the services we provide.</h6>
                                    <?php if($company->services->count()) : ?>
                                        <?php
                                            $max = $company->services->count();
                                            $count = 0;
                                        ?>

                                        <?php foreach($company->services as $service) : ?>
                                        <div class="row mt-3 mb-3">
                                            <div class="col-sm-2">
                                                <?php if( $service->pivot->image && \Illuminate\Support\Facades\Storage::exists($service->pivot->image)) : ?>
                                                <div class="icon" style="background-image: url({{ \Illuminate\Support\Facades\Storage::url($service->pivot->image) }});"></div>
                                                <?php else : ?>
                                                <div class="icon" style="background-image: url({{ asset('img/default-service.jpg') }}" alt="Image coming soon" ></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <h6>{{ $service->title }}</h6>
                                                {{--{!! \Illuminate\Support\Str::words($service->pivot->description, 30, '<a href="#">... Read More</a>') !!}--}}
                                                {!! $service->pivot->description !!}
                                                {{--<a href="#" class="btn btn-primary">View</a>--}}
                                            </div>
                                        </div>
                                        <?php
                                            $count++;
                                            if($max != $count) {
                                                echo '<hr>';
                                            }
                                        ?>
                                        <?php endforeach; ?>

                                    <?php else : ?>

                                    <div class="alert alert-warning mt-3">No services have been linked to this company.</div>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Services -->
                        <div id="jobs" class="tab-pane fade">

                        </div>

                        <!-- Media -->
                        <div id="gallery" class="tab-pane fade">

                            <h4 class="mb-4">Gallery</h4>

                            <?php if(isset($company->media) && $company->media->count()) : ?>

                                <?php
                                    $show = 'gallery';
                                    if(request()->exists('gallery'))
                                    {
                                        $show = request()->exists('gallery');
                                    }
                                ?>

                                <div class="row">
                                    {{-- FOR NOW SHOW ALL PHOTOS--}}
                                    <?php foreach ($company->media as $media) : ?>
                                        <?php
                                            if(!\Illuminate\Support\Facades\Storage::exists($media->file))
                                            {
                                                continue;
                                            }

                                            if(\Illuminate\Support\Facades\Storage::exists($media->thumb))
                                            {
                                                $img = \Illuminate\Support\Facades\Storage::url($media->thumb);
                                            }
                                            else
                                            {
                                                $img = \Illuminate\Support\Facades\Storage::url($media->file);
                                            }
                                            $url = \Illuminate\Support\Facades\Storage::url($media->file);
                                        ?>
                                        <div class="col-sm-6 col-md-4 col-lg-3 mb-3">

                                            <a data-fancybox="gallery-{{ $media->gallery_id }}" href="{{ $url }}">
                                            <div class="card card-bordered card-gallery">
                                                <div class="image">
                                                    <img src="{{ $img }}" width="200">
                                                </div>
                                            </div>
                                            </a>

                                        </div>

                                    <?php endforeach; ?>
                                </div>

                            <?php else : ?>
                                <div class="alert alert-warning mt-3">No photos have been added.</div>
                            <?php endif; ?>

                        </div>

                        <!-- Reviews -->
                        <div id="reviews" class="tab-pane {{ $review_posted ? 'active' : 'fade' }}">

                            <h4 class="mb-4">Reviews
                                <a id="addReviewBtn" href="#" class="button button-primary mt-3 mt-md-0  float-md-right">Submit Review</a>
                            </h4>

                            <!-- Add review -->
                            <div id="addReview" class="card card-bordered" style="display: {{ $review_posted ? 'block' : 'none' }}">
                                <div class="card-header">Submit a review</div>
                                <div class="card-body">

                                    <form class="row" method="post" action="{{ url('leave-review') }}">
                                        @csrf
                                        <input type="hidden" name="form_type" value="review">
                                        <input type="hidden" name="company_id" value="{{ $company->id }}">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First name *</label>
                                                <input class="form-input" type="text" name="first_name" value="{{ old('first_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last name *</label>
                                                <input class="form-input" type="text" name="last_name" value="{{ old('last_name') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Email *</label>
                                                <input class="form-input" type="email" name="email" value="{{ old('email') }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Review Title *</label>
                                                <input class="form-input" type="text" name="title" value="{{ old('title') }}" required>
                                            </div>
                                        </div>

                                        {{--summernote-single --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Review *</label>
                                                <textarea name="description" class="form-input" required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Rating *</label>
                                            <div class="clearfix"></div>
                                            <fieldset class="rate clickable">
                                                <input type="radio" id="rating10" name="rating" value="10" {{ is_checked(10, old('rating')) }} /><label for="rating10" title="5 stars"></label>
                                                <input type="radio" id="rating9" name="rating" value="9" {{ is_checked(9, old('rating')) }} /><label class="half" for="rating9" title="4 1/2 stars"></label>
                                                <input type="radio" id="rating8" name="rating" value="8" {{ is_checked(8, old('rating')) }} /><label for="rating8" title="4 stars"></label>
                                                <input type="radio" id="rating7" name="rating" value="7" {{ is_checked(7, old('rating')) }} /><label class="half" for="rating7" title="3 1/2 stars"></label>
                                                <input type="radio" id="rating6" name="rating" value="6" {{ is_checked(6, old('rating')) }} /><label for="rating6" title="3 stars"></label>
                                                <input type="radio" id="rating5" name="rating" value="5" {{ is_checked(5, old('rating')) }} /><label class="half" for="rating5" title="2 1/2 stars"></label>
                                                <input type="radio" id="rating4" name="rating" value="4" {{ is_checked(4, old('rating')) }} /><label for="rating4" title="2 stars"></label>
                                                <input type="radio" id="rating3" name="rating" value="3" {{ is_checked(3, old('rating')) }} /><label class="half" for="rating3" title="1 1/2 stars"></label>
                                                <input type="radio" id="rating2" name="rating" value="2" {{ is_checked(2, old('rating')) }} /><label for="rating2" title="1 star"></label>
                                                <input type="radio" id="rating1" name="rating" value="1" {{ is_checked(1, old('rating')) }} /><label class="half" for="rating1" title="1/2 star"></label>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group reviewUpload" data-type="proof">
                                                <label>Upload proof of works (Receipt)</label>
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

                                                <p class="text-info mt-2">Max file size 5mb</p>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="g-recaptcha mb-3" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}"></div>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>


                                    </form>


                                </div>
                            </div><!-- end add review -->

                            <?php if($company->reviews->count()) : ?>

                            <p class="mb-1">Total reviews {{ $company->reviews->count() }}</p>
                            <ul class="list-group mt-1">
                                <?php foreach ($company->reviews as $review) : $rating = round($review->rating*2) / 2; ?>
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

                            <?php else : ?>
                                <div class="alert alert-warning mt-3">No reviews have been added to this company.</div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stack('modals')

@push('scripts')
    <script src="{{ asset('libraries/summernote.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endpush
{{ view('templates/footer') }}

<script type="text/javascript">
    $('.view-reviews').on('click', function(e) {
       e.preventDefault();
       $('#reviews-tab').click();
    });

    $('#addReviewBtn').on('click', function(e) {
        e.preventDefault();
       $('#addReview').toggle();
    });

    $('.reviewUpload input[type=file]').on('change',function(e) {

        var ext = $(this).val().split(".");
        ext = ext[ext.length-1].toLowerCase();
        var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif", "pdf"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid file type',
                text: 'Please select a valid image or PDF file only, ' + ext + ' is not supported.',
                //footer: '<a href>Why do I have this issue?</a>'
            });
            $(this).val("");
            return;
        }

        var parent = $(this).parents('.reviewUpload');
        var field = parent.data('type');
        var myFile = $(this).prop('files')[0];
        var progress_container = parent.find('.progress-linear');
        var progress_text = parent.find('.progress-value');
        var progress_display = parent.find('.progress-bar-linear');

        // check file size
        if(myFile.size > 5000000)
        {
            Swal.fire({
                icon: 'error',
                title: 'File too big',
                text: 'Your file exceeded our limit of 5mb.',
                //footer: '<a href>Why do I have this issue?</a>'
            });
            $(this).val("");
            return;
        }

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

</script>
