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

            <!-- conent -->
            <div class="col-lg-7 col-xl-8 section-divided__main section-divided__main-left">
                <form method="post" action="{{ url('account') }}">
                    @csrf
                    <h4 class="mb-3">Your Details</h4>
                    <div class="row mt-1">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First name *</label>
                                <input class="form-input line3" type="text" name="user[first_name]" value="{{ old('user.first_name',$account->first_name) }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last name *</label>
                                <input class="form-input city" type="text" name="user[last_name]"  value="{{ old('user.last_name',$account->last_name) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email *</label>
                        <input class="form-input title" type="text" name="user[email]" id="email" value="{{ old('user.email', $account->email) }}" required>
                        <p class="text-info mt-2">This your login email, this is also used for account notifications / messages.</p>
                    </div>


                    <hr class="mb-3">

                    <h4 class="mb-3">Company Details</h4>

                    <div class="form-group">
                        <label>Company name *</label>
                        <input class="form-input title" type="text" name="company[title]" id="title" value="{{ isset($account->company) ? $account->company->title : '' }}">
                    </div>


                    <div class="form-group">
                        <label>Account phone number</label>
                        <input class="form-input title" type="tel" name="user[contact_number]" value="{{ isset($account->contact_number) ? $account->contact_number : '' }}">
                        <p class="text-info mt-2">This is only used for account queries.</p>
                    </div>

                    <!--registration_number, vat_number, phone, mobile,email, website-->
                    <div class="row mt-1 mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company registration no.</label>
                                <input class="form-input title" type="text" min="8" name="company[registration_number]" value="{{ isset($account->company->registration_number) ? $account->company->registration_number : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Vat number</label>
                                <input class="form-input title" type="text" min="9" name="company[vat_number]" value="{{ isset($account->company->vat_number) ? $account->company->vat_number : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="address-container">
                        <div class="form-group">
                            <label for="notes">Postcode *</label>
                            <input id="find-postcode" class="find-postcode form-input" value="" placeholder="Enter postcode">
                        </div>
                        <div class="form-group">
                            <button id="postcode-btn" type="button" class="submit-btn postcode-btn btn btn-outline-primary">Find addresses</button>
                        </div>

                        <div id="show-addresses" class="form-group show-addresses" style="display: none;">
                            <label>Addresses found</label>
                            <div class="form-control-wrap">

                            </div>

                        </div>

                        <hr class="mb-3">

                        <div class="form-group">
                            <label>Address name / Organisation</label>
                            <input class="form-input title" type="text" name="company[address_data][title]" id="title" value="{{ old('company.address_data.title',isset($account->company->address_data['title']) ? $account->company->address_data['title'] : '') }}">
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Line 1 *</label>
                                    <input class="form-input line1" type="text" name="company[address_data][line1]" id="line1" value="{{ old('company.address_data.line1', isset($account->company->address_data['line1']) ? $account->company->address_data['line1'] : '') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Line 2</label>
                                    <input class="form-input line2" type="text" name="company[address_data][line2]" id="line2" value="{{ old('company.address_data.line2', isset($account->company->address_data['line2']) ? $account->company->address_data['line2'] : '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Line 3</label>
                                    <input class="form-input line3" type="text" name="company[address_data][line3]" id="line3" value="{{ old('company.address_data.line3', isset($account->company->address_data['line3']) ? $account->company->address_data['line3'] : '') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City *</label>
                                    <input class="form-input city" type="text" name="company[address_data][city]" id="city" value="{{ old('company.address_data.city',isset($account->company->address_data['city']) ? $account->company->address_data['city'] : '') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Postcode *</label>
                                    <input class="form-input postcode" type="text" name="company[address_data][postcode]" value="{{ old('company.address_data.postcode', isset($account->company->address_data['postcode']) ? $account->company->address_data['postcode'] : '') }}" id="postcode" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>County</label>
                                    <input class="form-input county" type="text" name="company[address_data][county]" value="{{ old('company.address_data.county',isset($account->company->address_data['county']) ? $account->company->address_data['county'] : '') }}" id="county">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
                            if( !$ip_country = session('ip_location.country_name') ) {
                                $ip_country = 'United Kingdom';
                            }
                            ?>
                            <label>Country *</label>
                            <select class="form-control country" name="company[address_data][country]" id="add-country" required>
                                <?php if($countries = countries()) : ?>
                                <?php foreach($countries as $country) : ?>
                                <option value="{{ $country->title }}" data-country-code="{{$country->code}}" {{ is_selected($country->title, $ip_country) }}>{{$country->title}}</option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <input class="lat" type="hidden" id="lat" name="company[address_data][gps_lat]" value="{{ old('company.address_data.gps_lat',isset($account->company->address_data['gps_lat']) ? $account->company->address_data['gps_lat'] : '') }}">
                        <input class="lng" type="hidden" id="lng" name="company[address_data][gps_lng]" value="{{ old('company.address_data.gps_lng',isset($account->company->address_data['gps_lng']) ? $account->company->address_data['gps_lng'] : '') }}">
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                </form>


            </div>

            <!-- sidemenu -->
            <div class="col-lg-5 col-xl-4 section-divided__aside section__aside-left">
                {{ view('account.templates.side-menu') }}
            </div>
        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}

<script type="text/javascript">

</script>
