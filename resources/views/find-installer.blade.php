<?php
    extract(array_merge([
        'service'   => 'all',
        's'         => '',
        'postcode'  => '',
        'sort_by'   => 'rating',
        'radius'    => 'all'
    ],request()->all()));
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
                                <h2 class="heading-decorated">Search</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<section class="section section-lg bg-default">
    <div class="container">

        {{ view('templates/alert') }}

        <div class="row row-70 flex-lg">

            <!-- sidemenu -->
            <div class="col-lg-4 col-xl-3 section-divided__aside section__aside-left">
                <section class="section-sm">
                    <form id="search-form" action="{{ url('find-installer') }}" method="get">
                        <h4 class="mb-3">Search</h4>

                        <?php if( services()->count() ) : ?>
                        <div class="form-group">
                            <label>Service Required</label>
                            <select class="form-control country" name="service" id="add-service">
                                <option value="all">All available services</option>
                                <?php foreach(services() as $ser) : ?>
                                <option value="{{ $ser->id }}" {{ is_selected($ser->id, $service) }}>{{$ser->title}}</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="s" placeholder="If known" class="form-input" value="{{ $s }}">
                        </div>

                        <div class="form-group">
                            <label>Postcode</label>
                            <input type="text" name="postcode" placeholder="Your postcode" class="form-input" value="{{ $postcode }}">
                        </div>

                        <div class="form-group">
                            <label>Distance</label>
                            <select name="radius" class="form-control">
                                <option value="all">Distance (national)</option>
                                <option value="1" {{ is_selected(1, $radius) }}>Within 1 mile</option>
                                <option value="5" {{ is_selected(5, $radius) }}>Within 5 miles</option>
                                <option value="10" {{ is_selected(10, $radius) }}>Within 10 miles</option>
                                <option value="15" {{ is_selected(15, $radius) }}>Within 15 miles</option>
                                <option value="20" {{ is_selected(20, $radius) }}>Within 20 miles</option>
                                <option value="25" {{ is_selected(25, $radius) }}>Within 25 miles</option>
                                <option value="30" {{ is_selected(30, $radius) }}>Within 30 miles</option>
                                <option value="35" {{ is_selected(35, $radius) }}>Within 35 miles</option>
                                <option value="40" {{ is_selected(40, $radius) }}>Within 40 miles</option>
                                <option value="45" {{ is_selected(45, $radius) }}>Within 45 miles</option>
                                <option value="50" {{ is_selected(50, $radius) }}>Within 50 miles</option>
                                <option value="55" {{ is_selected(55, $radius) }}>Within 55 miles</option>
                                <option value="60" {{ is_selected(60, $radius) }}>Within 60 miles</option>
                                <option value="70" {{ is_selected(70, $radius) }}>Within 70 miles</option>
                                <option value="80" {{ is_selected(80, $radius) }}>Within 80 miles</option>
                                <option value="90" {{ is_selected(90, $radius) }}>Within 90 miles</option>
                                <option value="100" {{ is_selected(100, $radius) }}>Within 100 miles</option>
                                <option value="200" {{ is_selected(200, $radius) }}>Within 200 miles</option>
                            </select>
                        </div>

                        <button type="submit" class="btn button-primary text-uppercase">Search</button>
                        <a href="{{ url('find-installer') }}" class="button button-primary-outline btn-sm mt-2">Reset</a>
                    </form>
                </section>
            </div>

            <!-- content -->
            <div class="col-lg-8 col-xl-9 section-divided__main section-divided__main-left">

                <?php if(isset($companies) && $companies->count()) : ?>

                    <div class="text-muted mb-4">
                        Showing <strong>{{ $companies->count() }}</strong> results of total <strong>{{ $companies->total() }}</strong> found.

                        <div class="float-md-right" style="width: 200px">
                            <select name="sort_by" class="form-input" form="search-form">
                                <option value="rating" {{ is_selected('rating', $sort_by) }}>Rating</option>
                                <option value="relevance" {{ is_selected('relevance', $sort_by) }}>Relevance</option>
                                <option value="distance" {{ is_selected('distance', $sort_by) }}>Distance (requires postcode)</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <?php foreach($companies as $company) : record_stat($company->id, 'search'); ?>
                    <div class="card card-bordered profile-list mb-3">
                        <div class="row">
                            <div class="col-sm-2 text-center">
                                <a href="{{ route('business_profile',[$company->id,slug($company->title)]) }}" target="_blank">
                                <?php if($company->avatar && \Illuminate\Support\Facades\Storage::exists($company->avatar)) : ?>
                                    <div class="sidebar-thumbnail p-2">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($company->avatar) }}"  width="200" alt="">
                                    </div>
                                <?php else : ?>
                                    <div class="sidebar-thumbnail p-2">
                                        <img src="{{ asset('img/default-service.jpg') }}"  width="200" alt="">
                                    </div>
                                <?php endif; ?>
                                </a>
                            </div>
                            <div class="profile-padding col-sm-10">
                                <div class="card-body profile-padding">
                                    <h5>
                                        <a href="{{ route('business_profile',[$company->id,slug($company->title)]) }}" target="_blank">{{ $company->title }}</a>
                                        <?php if($company->verified) : ?>
                                        <a href="{{ url('verified-company') }}" target="_blank"><span data-toggle="tooltip" data-placement="top" title="Verified Company"><img src="{{ asset('img/icon-verified.png') }}" width="16" alt="" ></span></a>
                                        <?php else :  ?>
                                        <a href="{{ url('verified-company') }}" target="_blank"><span data-toggle="tooltip" data-placement="top" title="Not Verified"><img src="{{ asset('img/icon-not-verified.png') }}" width="16" alt="" ></span></a>
                                        <?php endif; ?>
                                        <?php
                                            $rating = 0;
                                            $avg = 0;
                                            if($company->reviews->count())
                                            {
                                                $rating_avg = $company->average_rating;//$company->reviews()->avg('rating');
                                                $rating = round($rating_avg*2) / 2;
                                            }
                                        ?>
                                        <div class="float-md-right p-4">
                                            <fieldset class="rate {{ $rating ? '' : 'light' }} small">
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

                                    </h5>
                                    <span class="text-muted mt-3">
                                        {!! \Illuminate\Support\Str::words($company->about,40,'... <a href="'.route('business_profile',[$company->id,slug($company->title)]).'">view</a>') !!}
                                    </span>
                                    <?php if(isset($company->services) && $company->services->count()) : ?>
                                        <ul class="list-marked">
                                            <?php foreach ($company->services as $service) : ?>
                                                <li>{{ $service->title }}</li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card-footer">
                                    <div class="float-right">
                                        <?php
                                            $remove = ["https://", "http://", "/"];
                                            $city = isset($company->address_data['city']) ? $company->address_data['city'] : null;
                                        ?>
                                        <a class="record-click" data-type="website" data-id="{{ $company->id }}" href="{{ $company->website }}" target="_blank">{{ @str_replace($remove,'',$company->website) }}</a>
                                    </div>
                                    <div class="company-profile-links">
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

                                        <span class="ml-3 text-muted" style="font-size: 14px;">
                                            <?php if(!is_null($city)) : ?>
                                                <span class="fa fa-map-marker"></span>
                                                {{ $city }}
                                                <?php endif; ?>
                                                <?php if(isset($company->distance)) : ?>
                                                {{ number_format($company->distance,2,'.',',').' miles away from '.$postcode }}
                                            <?php endif; ?>
                                        </span>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                    <?php endforeach; ?>

                    {{ $companies->links() }}

                <?php else : ?>

                    <div class="alert alert-warning p-3">There are no installers to display at this time, if you are searching for someone in your location, try expanding the search radius.</div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

@stack('modals')

@push('scripts')
    <script src="{{ asset('libraries/summernote.js') }}"></script>
@endpush
{{ view('templates/footer') }}

<script type="text/javascript">
    $(document).ready(function() {
       $('ul').addClass('mt-2');
    });

    $('[name="sort_by"]').on('change',function() {
        $('#search-form').submit();
    });
</script>
