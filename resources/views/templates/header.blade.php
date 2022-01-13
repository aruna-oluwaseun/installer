<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title-->
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="keywords" content="Fedca, Decorative Coatings, Resin, Floors, Walls, Desktops, Decorate, Home, Refurbishment">
    <meta name="description" content= "Welcome the Fedca, We are the decorative coatings federation, our aim is to provide quality assured installers to the public." />
    <meta name="robots" content= "index, follow">

    <link rel="icon" href="{{ asset('favicons/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fedca.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/remains.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">

    <?php if(!strstr($_SERVER['REQUEST_URI'],'business')) : ?>
    <meta property="og:title" content="Fedca the Decorative Coatings Association" />
    <meta property="og:description" content="Fedca has a whole host of vetted installers to make sure you have the job done the right way the first time." />
    <meta property="og:image" content="{{ asset('img/og-image.jpg') }}" />
    <?php endif; ?>

    @stack('styles')
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div id="page-loader">
    <div class="cssload-container">
        <div class="cssload-speeding-wheel"></div>
    </div>
</div>
<!-- Page-->
<div class="page">
    <header class="page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap" style="height: 151px;">
            <nav class="rd-navbar rd-navbar-original rd-navbar-static" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-xl-device-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-stick-up-clone="false" data-sm-stick-up="true" data-md-stick-up="true" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true" data-lg-stick-up-offset="120px" data-xl-stick-up-offset="35px" data-xxl-stick-up-offset="35px">
                <!-- RD Navbar Top Panel-->
                <div class="rd-navbar-top-panel rd-navbar-search-wrap toggle-original-elements">
                    <div class="rd-navbar-top-panel__main toggle-original-elements">
                        <div class="rd-navbar-top-panel__toggle rd-navbar-fixed__element-1 rd-navbar-static--hidden toggle-original" data-rd-navbar-toggle=".rd-navbar-top-panel__main"><span></span></div>
                        <div class="rd-navbar-top-panel__content">
                            <div class="rd-navbar-top-panel__left">
                                <p>{{ env('SLOGAN') }}</p>
                            </div>
                            <div class="rd-navbar-top-panel__right">
                                <ul class="rd-navbar-items-list">
                                    <li>
                                        <ul class="list-inline-xxs">
                                            <?php if(is_logged_in()) : ?>
                                                <li><a href="{{ url('account') }}">My Account</a></li>
                                                <li><a href="{{ url('sign-out') }}">Sign out</a></li>
                                            <?php else : ?>
                                                <li><a href="{{ url('login') }}">Sign In</a></li>
                                                <li><a href="{{ url('register') }}">Create an Account</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul class="list-inline-xxs">
                                            <li><a class="icon icon-xxs icon-primary fa fa-facebook" href="{{ env('FACEBOOK') }}"></a></li>
                                            <li><a class="icon icon-xxs icon-primary fa fa-twitter" href="{{ env('TWITTER') }}"></a></li>
                                            <li><a class="icon icon-xxs icon-primary fa fa-instagram" href="{{ env('INSTAGRAM') }}"></a></li>
                                            {{--<li><a class="icon icon-xxs icon-primary fa fa-google-plus" href="#"></a></li>
                                            <li><a class="icon icon-xxs icon-primary fa fa-vimeo" href="#"></a></li>
                                            <li><a class="icon icon-xxs icon-primary fa fa-youtube" href="#"></a></li>
                                            <li><a class="icon icon-xxs icon-primary fa fa-pinterest-p" href="#"></a></li>--}}
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="rd-navbar-top-panel__aside">
                        <ul class="rd-navbar-items-list">
                            <li>
                                <div class="rd-navbar-fixed__element-2">
                                    <button class="rd-navbar-search__toggle rd-navbar-search__toggle_additional toggle-original" data-rd-navbar-toggle=".rd-navbar-search-wrap"></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- RD Search-->
                    <div class="rd-navbar-search rd-navbar-search_toggled rd-navbar-search_not-collapsable">
                        <form class="rd-search" action="{{ url('find-installer') }}" method="GET" {{--data-search-live="rd-search-results-live"--}}>
                            <div class="form-wrap">
                                <input class="form-input" id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off">
                                <label class="form-label rd-input-label" for="rd-navbar-search-form-input">Enter keyword</label>
                               {{-- <div class="rd-search-results-live cleared" id="rd-search-results-live"></div>--}}
                            </div>
                            <button class="rd-search__submit" type="submit"></button>
                        </form>
                        <div class="rd-navbar-fixed--hidden">
                            <button class="rd-navbar-search__toggle" {{--data-custom-toggle=".rd-navbar-search-wrap" data-custom-toggle-disable-on-blur="true"--}}></button>
                        </div>
                    </div>
                </div>
                <div class="rd-navbar-inner">
                    <!-- RD Navbar Panel-->
                    <div class="rd-navbar-panel">
                        <button class="rd-navbar-toggle toggle-original" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand"><a class="brand-name" href="/"><img src="{{ asset('img/Fedca-Decorative-Coatings-Logo-Light.png') }}" alt="Fedca - Decorative Coatings Association" width="232" height="68"></a></div>
                    </div>
                    <!-- RD Navbar Nav-->
                    <div class="rd-navbar-nav-wrap toggle-original-elements">

                        <?php if(is_installer()) : ?>
                            <div class="rd-navbar-nav-wrap__element"><a class="button button-gray-light-outline" href="{{ route('business_profile',[current_user_company_id(),slug(get_user()->company->title)]) }}">View Company Profile</a></div>
                        <?php else : ?>
                            <div class="rd-navbar-nav-wrap__element"><a class="button button-gray-light-outline" href="{{ url('find-installer') }}">Find Installer</a></div>
                        <?php endif; ?>

                        <ul class="rd-navbar-nav">
                            <li class="{{ is_active_menu('home') ? 'active' : '' }}"><a href="/">Home</a></li>
                            <li class="{{ is_active_menu('about') ? 'active' : '' }}"><a href="{{ url('about') }}">About Fedca</a></li>
                            <li class="rd-navbar--has-dropdown rd-navbar-submenu {{ is_active_menu('benefits', true) ? 'active' : '' }}">
                                <a href="#">Membership</a>
                                <ul class="rd-navbar-dropdown">
                                    <li class="{{ is_active_menu('benefits/packages') ? 'active' : '' }}"><a href="{{ url('packages') }}">Packages</a></li>
                                    {{--<li class="{{ is_active_menu('benefits/benefits') ? 'active' : '' }}"><a href="{{ url('benefits') }}">Benefits</a></li>--}}
                                    <li class="{{ is_active_menu('benefits/how-it-works') ? 'active' : '' }}"><a href="{{ url('how-it-works') }}">How it Works</a></li>
                                    <li class="{{ is_active_menu('benefits/verified-company') ? 'active' : '' }}"><a href="{{ url('verified-company') }}">What is a verified member?</a></li>
                                </ul>
                            </li>
                            <li class="{{ is_active_menu('find-installer') ? 'active' : '' }}"><a href="{{ url('find-installer') }}">Find Installer</a></li>

                            <li class="{{ is_active_menu('blog') ? 'active' : '' }}"><a href="{{ url('blog') }}">Blog</a></li>



                            {{--<li class="{{ is_active_menu('training') ? 'active' : '' }}"><a href="#">Training</a></li>--}}
                            <li class="{{ is_active_menu('contact') ? 'active' : '' }}"><a href="{{ url('contact') }}">Contacts</a></li>
                            <?php if(is_logged_in()) : ?>
                            <li class="rd-navbar--has-dropdown rd-navbar-submenu {{ is_active_menu('account', true) ? 'active' : '' }}">
                                <a href="#">Account</a>
                                <ul class="rd-navbar-dropdown">
                                    <li class="{{ is_active_menu('company/profile') ? 'active' : '' }}"><a href="{{ url('company/profile') }}">Company Profile</a></li>
                                    <li class="{{ is_active_menu('account') ? 'active' : '' }}"><a href="{{ url('account') }}">Account Details</a></li>
                                    <li class="{{ is_active_menu('account/payment') ? 'active' : '' }}"><a href="{{ url('account/payment-method') }}">Payment Method</a></li>
                                    <li class="{{ is_active_menu('account/package') ? 'active' : '' }}"><a href="{{ url('account/package') }}">Package</a></li>
                                    {{--<li class="{{ is_active_menu('account/settings') ? 'active' : '' }}"><a href="{{ url('account/settings') }}">Settings</a></li>
                                    <li class="{{ is_active_menu('account/notifications') ? 'active' : '' }}"><a href="{{ url('account/notifications') }}">Notifications</a></li>--}}
                                </ul>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
