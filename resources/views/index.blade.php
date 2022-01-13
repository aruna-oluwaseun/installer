{{ view('templates/header') }}
<!-- Swiper-->
<section>
    <div class="swiper-container swiper-slider swiper-slider_fullheight bg-gray-dark" data-simulate-touch="false" data-loop="true" data-autoplay="5000">
        <div class="swiper-wrapper">
            <div class="swiper-slide" data-slide-bg="{{ asset('img/slider/stone-wrap.jpg') }}">
                <div class="swiper-slide-caption text-right">
                    <div class="container">
                        <div class="row justify-content-center justify-content-xxl-end">
                            <div class="col-lg-10 col-xxl-7">
                                <h1 data-caption-animate="fadeInUpSmall">Stone Wrap</h1>
                                <h5 class="font-weight-normal" data-caption-animate="fadeInUpSmall" data-caption-delay="200">Real stone wrap perfect for interiors and exteriors.</h5><a class="button button-primary" data-caption-animate="fadeInUpSmall" data-caption-delay="350" href="{{ url('find-installer') }}">Find an Installer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide text-left" data-slide-bg="{{ asset('img/slider/resin-counters.jpg') }}">
                <div class="swiper-slide-caption">
                    <div class="container">
                        <div class="row justify-content-lg-center">
                            <div class="col-lg-10">
                                <h1 data-caption-animate="fadeInUpSmall">Find Installer</h1>
                                <h5 class="font-weight-normal" data-caption-animate="fadeInUpSmall" data-caption-delay="200">Our team can assist you .</h5><a class="button button-primary" data-caption-animate="fadeInUpSmall" data-caption-delay="350" href="{{ url('find-installer') }}">Find an Installer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide text-center" data-slide-bg="{{ asset('img/slider/fedca.jpg') }}">
                <div class="swiper-slide-caption text-center">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-10 col-xxl-6">
                                <h1 data-caption-animate="fadeInUpSmall">Join Today</h1>
                                <h5 class="font-weight-normal" data-caption-animate="fadeInUpSmall" data-caption-delay="200">Get 6 months free </h5><a class="button button-primary" data-caption-animate="fadeInUpSmall" data-caption-delay="350" href="{{ url('register') }}">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination"></div>
        <!-- Swiper Navigation-->
        <div class="swiper-button-prev linear-icon-chevron-left"></div>
        <div class="swiper-button-next linear-icon-chevron-right"></div>
    </div>
</section>

<section class="section-xs section-cta bg-image bg-accent text-center text-md-left">
    <div class="container">
        <div class="row row-30 justify-content-between align-items-center">
            <div class="col-12 col-md-8">
                <h4>Find your local installer</h4>
                <h5>FEDCA makes it easier to find quality local tradesperson’s who specialise in decorative coatings & other trades.</h5>
            </div>
            <div class="col-12 col-md-4 text-md-right"><a class="button button-primary" href="{{ url('find-installer') }}">Start now</a></div>
        </div>
    </div>
</section>
<!-- Our Services-->
<section class="section-md bg-default text-center">
    <div class="container">
        <h4 class="heading-decorated">Find Installer</h4>
        <div class="row justify-content-center">
            <form class="rd-search rd-mailform-inline-flex" action="{{ url('find-installer') }}" method="GET">
                <div class="form-wrap">
                    <input type="text" name="postcode" placeholder="Your postcode" class="form-input" value="">
                </div>
                <div class="form-wrap form-wrap_icon">
                    <select class="form-control country" name="service" id="add-service">
                        <option value="all">All available services</option>
                        <?php foreach(services() as $s) : ?>
                        <option value="{{ $s->id }}">{{$s->title}}</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="button button-primary" type="submit">Go!</button>
            </form>
        </div>
        <div class="row justify-content-center">
            <h5 class="text-muted">Or view all installers</h5>
        </div>
        <div class="row justify-content-center">
            <a href="{{ url('find-installer') }}" class="btn btn-primary">Directory</a>
        </div>
    </div>
</section>

<!-- About us-->
{{--<section class="bg-gray-lighter object-wrap">
    <div class="section-lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <h4 class="heading-decorated">About us</h4>
                    <p>We are a team of professional, energetic individuals with talented designers and experienced managers available to guide our clients through the flawless and timely execution of any residential design project. Since day one, we have been delivering creative and cozy interiors to our clients worldwide.</p>
                    <div class="row row-30">
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <!-- Blurb minimal-->
                            <article class="blurb blurb-minimal">
                                <div class="unit flex-row unit-spacing-md">
                                    <div class="unit-left">
                                        <div class="blurb-minimal__icon"><span class="icon linear-icon-menu3"></span></div>
                                    </div>
                                    <div class="unit-body">
                                        <p class="blurb__title heading-6"><a href="{{ url('#') }}">Award-winning designs</a></p>
                                        <p>We have received numerous awards for our designs, concepts, and ideas.</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-6 col-lg-12 col-xl-6">
                            <!-- Blurb minimal-->
                            <article class="blurb blurb-minimal">
                                <div class="unit flex-row unit-spacing-md">
                                    <div class="unit-left">
                                        <div class="blurb-minimal__icon"><span class="icon linear-icon-users2"></span></div>
                                    </div>
                                    <div class="unit-body">
                                        <p class="blurb__title heading-6"><a href="{{ url('#') }}">Expert team</a></p>
                                        <p>We are a team of dedicated interior design and remodeling professionals.</p>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-12">
                            <!-- Linear progress bar-->
                            <div class="progress-linear progress-linear-modern">
                                <div class="progress-header">
                                    <p>Interior Design</p><span class="progress-value">49</span>
                                </div>
                                <div class="progress-bar-linear-wrap">
                                    <div class="progress-bar-linear"></div>
                                </div>
                            </div>
                            <!-- Linear progress bar-->
                            <div class="progress-linear progress-linear-modern">
                                <div class="progress-header">
                                    <p>Interior Planning</p><span class="progress-value">29</span>
                                </div>
                                <div class="progress-bar-linear-wrap">
                                    <div class="progress-bar-linear"></div>
                                </div>
                            </div>
                            <!-- Linear progress bar-->
                            <div class="progress-linear progress-linear-modern">
                                <div class="progress-header">
                                    <p>Consultations</p><span class="progress-value">86</span>
                                </div>
                                <div class="progress-bar-linear-wrap">
                                    <div class="progress-bar-linear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="object-wrap__body object-wrap__body-sizing-1 object-wrap__body-md-right bg-image" style="background-image: url(/img/bg-image-1.jpg)"></div>
</section>--}}

<!-- What we work on -->
{{--<section class="section-md bg-default text-center">
    <div class="container">
        <h4 class="heading-decorated">What we work on</h4>
        <div class="row row-50">
            <div class="col-md-6 col-xl-4">
                <!-- Post project-->
                <article class="post-project"><a class="img-thumbnail-variant-1" href="/img/project-1-652x491.jpg" data-lightgallery="item">
                        <figure><img class="post-project__image" src="/img/project-1-652x491.jpg" alt="" width="652" height="491"/>
                        </figure>
                        <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                    <div class="post-project__body">
                        <h6 class="post-project__title"><a href="{{ url('find-installer') }}">Offices</a></h6>
                        <p>Our design studio often deals with office remodeling and redesign. We can successfully transform your office into a visually attractive center of business activity.</p><a class="button button-link" href="{{ url('find-installer') }}">View Projects</a>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-xl-4">
                <!-- Post project-->
                <article class="post-project"><a class="img-thumbnail-variant-1" href="/img/project-2-652x491.jpg" data-lightgallery="item">
                        <figure><img class="post-project__image" src="/img/project-2-652x491.jpg" alt="" width="652" height="491"/>
                        </figure>
                        <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                    <div class="post-project__body">
                        <h6 class="post-project__title"><a href="{{ url('find-installer') }}">Living Rooms</a></h6>
                        <p>We will gladly create a new stunning interior design for your living room taking into account all your wishes and considerations to make it look even better.</p><a class="button button-link" href="{{ url('find-installer') }}">View Projects</a>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-xl-4">
                <!-- Post project-->
                <article class="post-project"><a class="img-thumbnail-variant-1" href="/img/project-3-652x491.jpg" data-lightgallery="item">
                        <figure><img class="post-project__image" src="/img/project-3-652x491.jpg" alt="" width="652" height="491"/>
                        </figure>
                        <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                    <div class="post-project__body">
                        <h6 class="post-project__title"><a href="{{ url('find-installer') }}">Studios</a></h6>
                        <p>While not being limited by residential projects and office remodeling, we are also eager to work on designing studios and educational centers.</p><a class="button button-link" href="{{ url('find-installer') }}">View Projects</a>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-xl-4">
                <!-- Post project-->
                <article class="post-project"><a class="img-thumbnail-variant-1" href="/img/project-4-652x491.jpg" data-lightgallery="item">
                        <figure><img class="post-project__image" src="/img/project-4-652x491.jpg" alt="" width="652" height="491"/>
                        </figure>
                        <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                    <div class="post-project__body">
                        <h6 class="post-project__title"><a href="{{ url('find-installer') }}">Terraces</a></h6>
                        <p>Terraces and porches can be described as both indoor and outdoor areas and our skills and professionalism allow us to work on their visual and functional improvement.</p><a class="button button-link" href="{{ url('find-installer') }}">View Projects</a>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-xl-4">
                <!-- Post project-->
                <article class="post-project"><a class="img-thumbnail-variant-1" href="/img/project-5-652x491.jpg" data-lightgallery="item">
                        <figure><img class="post-project__image" src="/img/project-5-652x491.jpg" alt="" width="652" height="491"/>
                        </figure>
                        <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                    <div class="post-project__body">
                        <h6 class="post-project__title"><a href="{{ url('find-installer') }}">Kitchens</a></h6>
                        <p>Whether it is a part of a residential house or a restaurant, a nicely structured and well-designed kitchen is vital for better experience regardless of its size.</p><a class="button button-link" href="{{ url('find-installer') }}">View Projects</a>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-xl-4">
                <!-- Post project-->
                <article class="post-project"><a class="img-thumbnail-variant-1" href="/img/project-6-652x491.jpg" data-lightgallery="item">
                        <figure><img class="post-project__image" src="/img/project-6-652x491.jpg" alt="" width="652" height="491"/>
                        </figure>
                        <div class="caption"><span class="icon icon-lg linear-icon-magnifier"></span></div></a>
                    <div class="post-project__body">
                        <h6 class="post-project__title"><a href="{{ url('find-installer') }}">Guest rooms</a></h6>
                        <p>Looking for an idea to create a new or transform an old guest room? Trust our exceptionally skilled designers and architects if you are aiming for the best results.</p><a class="button button-link" href="{{ url('find-installer') }}">View Projects</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>--}}

<!-- counters-->
<section class="section-md bg-accent text-center">
    <div class="container">
        <div class="row row-30 justify-content-between align-items-center">
            <div class="col-12 col-md-8">
                <h3>Register your trade account</h3>
                <h5>6 Months free when you register today</h5>
            </div>
            <div class="col-12 col-md-4 text-md-right"><a class="button button-primary" href="{{ url('register') }}">Register</a></div>
        </div>
    </div>
    {{--<div class="container">
        <div class="row justify-content-md-center row-50">
            <div class="col-md-6 col-lg-4">
                <!-- Box counter-->
                <article class="box-counter">
                    <div class="box-counter__icon linear-icon-user-plus"></div>
                    <div class="box-counter__wrap">
                        <div class="counter">120</div>
                    </div>
                    <p class="box-counter__title">Verified Installers</p>
                </article>
            </div>
            --}}{{--<div class="col-md-6 col-lg-3">
                <!-- Box counter-->
                <article class="box-counter">
                    <div class="box-counter__icon linear-icon-cube"></div>
                    <div class="box-counter__wrap">
                        <div class="counter">45</div>
                    </div>
                    <p class="box-counter__title">Awards</p>
                </article>
            </div>--}}{{--
            <div class="col-md-6 col-lg-4">
                <!-- Box counter-->
                <article class="box-counter">
                    <div class="box-counter__icon linear-icon-star"></div>
                    <div class="box-counter__wrap">
                        <div class="counter">4</div><span>.5</span>
                    </div>
                    <p class="box-counter__title">Avg Installer Rating</p>
                </article>
            </div>
            <div class="col-md-6 col-lg-4">
                <!-- Box counter-->
                <article class="box-counter">
                    <div class="box-counter__icon linear-icon-smile"></div>
                    <div class="box-counter__wrap">
                        <div class="counter">10</div><span>k</span>
                    </div>
                    <p class="box-counter__title">Customers Helped</p>
                </article>
            </div>
        </div>
    </div>--}}
</section>
<!-- Projects-->
<section class="section-lg bg-default text-center">
    <div class="container">
        <h4 class="heading-decorated">Projects</h4>
        <div class="row row-30">
            <div class="col-sm-6 col-lg-4">
                <!-- Thumb creative-->
                <div class="thumb-creative">
                    <div class="thumb-creative__inner">
                        <div class="thumb-creative__front">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="{{ asset('img/home-project-1.jpg') }}" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6>Metallic Resin</h6>
                            </div>
                        </div>
                        <div class="thumb-creative__back">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="{{ asset('img/home-project-1.jpg') }}" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6 class="thumb-creative__title"><a href="{{ url('find-installer') }}">Metallic Resin</a></h6>
                                <p>More information coming soon</p><a class="button button-link" href="{{ url('find-installer') }}">VIEW MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <!-- Thumb creative-->
                <div class="thumb-creative">
                    <div class="thumb-creative__inner">
                        <div class="thumb-creative__front">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="/img/project-2-480x361.jpg" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6>Polished Concrete</h6>
                            </div>
                        </div>
                        <div class="thumb-creative__back">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="/img/project-2-480x361.jpg" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6 class="thumb-creative__title"><a href="{{ url('find-installer') }}">Polished Concrete</a></h6>
                                <p>More information coming soon</p><a class="button button-link" href="{{ url('find-installer') }}">VIEW MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <!-- Thumb creative-->
                <div class="thumb-creative">
                    <div class="thumb-creative__inner">
                        <div class="thumb-creative__front">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="/img/project-3-480x361.jpg" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6>Micro Cement</h6>
                            </div>
                        </div>
                        <div class="thumb-creative__back">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="/img/project-3-480x361.jpg" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6 class="thumb-creative__title"><a href="{{ url('find-installer') }}">Micro Cement</a></h6>
                                <p>More information coming soon</p><a class="button button-link" href="{{ url('find-installer') }}">VIEW MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <!-- Thumb creative-->
                <div class="thumb-creative">
                    <div class="thumb-creative__inner">
                        <div class="thumb-creative__front">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="/img/project-4-480x361.jpg" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6>Resin Bound Driveways</h6>
                            </div>
                        </div>
                        <div class="thumb-creative__back">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="/img/project-4-480x361.jpg" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6 class="thumb-creative__title"><a href="{{ url('find-installer') }}">Resin Bound Driveways</a></h6>
                                <p>More information coming soon</p><a class="button button-link" href="{{ url('find-installer') }}">VIEW MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <!-- Thumb creative-->
                <div class="thumb-creative">
                    <div class="thumb-creative__inner">
                        <div class="thumb-creative__front">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="{{ asset('img/home-project-stone-wrap.jpg') }}" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6>Stone Veneer</h6>
                            </div>
                        </div>
                        <div class="thumb-creative__back">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="{{ asset('img/home-project-stone-wrap.jpg') }}" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6 class="thumb-creative__title"><a href="{{ url('find-installer') }}">Stone Veneer</a></h6>
                                <p>More information coming soon</p><a class="button button-link" href="{{ url('find-installer') }}">VIEW MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <!-- Thumb creative-->
                <div class="thumb-creative">
                    <div class="thumb-creative__inner">
                        <div class="thumb-creative__front">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="/img/project-6-480x361.jpg" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6>Venetian Plaster</h6>
                            </div>
                        </div>
                        <div class="thumb-creative__back">
                            <figure class="thumb-creative__image-wrap"><img class="thumb-creative__image" src="/img/project-6-480x361.jpg" alt="" width="480" height="361"/>
                            </figure>
                            <div class="thumb-creative__content">
                                <h6 class="thumb-creative__title"><a href="{{ url('find-installer') }}">Venetian Plaster</a></h6>
                                <p>More information coming soon</p><a class="button button-link" href="{{ url('find-installer') }}">VIEW MORE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--cta-->

<!-- Call to Action-->
{{--<section class="section-md bg-accent bg-image text-center" style="background-image: url(/img/bg-image-8.jpg)">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-11 col-lg-9 col-xl-8">
                <h4 class="heading-decorated">If you can envision it, then we can design it. <br>Tell us more about your project! </h4><a class="button button-primary" href="contacts.html">Contact Us</a>
            </div>
        </div>
    </div>
</section>--}}

<!-- Meet Our Team-->
{{--<section class="section-md bg-default text-center">
    <div class="container">
        <h4 class="heading-decorated">Meet Our Team</h4>
        <div class="row row-50">
            <div class="col-md-6 col-lg-4">
                <!-- Thumb flat-->
                <article class="thumb-flat"><img class="thumb-flat__image" src="/img/calvin-fitzerald-418x315.jpg" alt="" width="418" height="315"/>
                    <div class="thumb-flat__body">
                        <p class="heading-6"><a href="team-member-profile.html">Calvin Fitgerald</a></p>
                        <p class="thumb-flat__subtitle">Founder, Managing Director</p>
                        <p>Calvin brings 20 years of experience as an interior designer, architect, and manager to his role as Founder of our studio. Invested in the continued renewal of downtown of our city, Mr. Fitzgerald is an advocate for high-performance creative office and residential space and sustainable urban development. He is our #1 advisor when solving the most complex tasks.</p>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-lg-4">
                <!-- Thumb flat-->
                <article class="thumb-flat"><img class="thumb-flat__image" src="/img/taylor-wilson-418x315.jpg" alt="" width="418" height="315"/>
                    <div class="thumb-flat__body">
                        <p class="heading-6"><a href="team-member-profile.html">Taylor Wilson</a></p>
                        <p class="thumb-flat__subtitle">Senior Interior Designer</p>
                        <p>For Taylor, good design is the result of curiosity, careful listening and asking far too many questions. He is driven to fully understand the needs, aspirations, and frustrations of clients and end users in order to create spaces where people truly want to be. After 16 years of design and project leadership experience, he is an expert in bringing a client’s ideas to life.</p>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-lg-4">
                <!-- Thumb flat-->
                <article class="thumb-flat"> <img class="thumb-flat__image" src="/img/josh-wagner-418x315.jpg" alt="" width="418" height="315"/>
                    <div class="thumb-flat__body">
                        <p class="heading-6"><a href="team-member-profile.html">Josh Wagner</a></p>
                        <p class="thumb-flat__subtitle">Lead Architect</p>
                        <p>Josh is one of our lead specialists in remodeling and redesign of all kinds of spaces. A Registered Architect, he has led teams as project architect/project manager on a broad range of project types and sizes. Having joined us in 2000, Josh Wagner brings significant professional expertise to his role on the Interior Design firmwide Technical Committee.</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>--}}

<!-- get a quote-->
<section id="contact" class="bg-gray-lighter object-wrap">
    <div class="section-lg">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-5">
                    {{ view('templates.alert') }}

                    <h4 class="heading-decorated">Get in Touch</h4>
                    <!-- RD Mailform-->
                    <form class="rd-mailform_style-1" method="post" action="{{ url('contact#contact') }}">
                        @csrf
                        <div class="form-wrap">
                            <input class="form-input" id="contact-name" type="text" name="name" value="{{ old('name') }}" data-constraints="@Required">
                            <label class="form-label" for="contact-name">Your name</label>
                        </div>
                        <div class="form-wrap">
                            <input class="form-input" id="contact-email" type="email" name="email" value="{{ old('email') }}" data-constraints="@Email @Required">
                            <label class="form-label" for="contact-email">Your e-mail</label>
                        </div>
                        <div class="form-wrap">
                            <textarea class="form-input" id="contact-message" name="message" data-constraints="@Required">{{ old('message') }}</textarea>
                            <label class="form-label" for="contact-message">Your message</label>
                        </div>
                        <div class="form-wrap">
                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}"></div>
                        </div>
                        <button class="button button-primary" type="submit">send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="object-wrap__body object-wrap__body-sizing-1 object-wrap__body-md-left bg-image" style="background-image: url({{ asset('img/resin-bg.jpg') }})"></div>
</section>

<!-- Posts-->
{{--<section class="section-md bg-default">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h4 class="heading-decorated">Recent News </h4>
            </div>
        </div>
        <div class="row row-60">
            <!-- Owl Carousel-->
            <div class="owl-carousel" data-items="1" data-sm-items="2" data-xl-items="3" data-dots="true" data-nav="false" data-stage-padding="15" data-margin="30" data-mouse-drag="false" data-loop="true" data-autoplay="true">
                <div class="owl-item">
                    <!-- Post classic-->
                    <article class="post-classic post-minimal"><img src="/img/home-post-2-418x315.jpg" alt="" width="418" height="315"/>
                        <div class="post-classic-title">
                            <h6><a href="image-post.html">7 Ways to Add a Custom Look to Your Home</a></h6>
                        </div>
                        <div class="post-meta">
                            <div class="group"><a href="image-post.html">
                                    <time datetime="2017">Jan.20, 2017</time></a><a class="meta-author" href="image-post.html">by Brian Williamson</a></div>
                        </div>
                        <div class="post-classic-body">
                            <p>When we hear the word “custom” we tend to think of the words, “high-end” and “expensive”. This may be true, but in life, we generally get… </p>
                        </div>
                    </article>
                </div>
                <div class="owl-item">
                    <!-- Post classic-->
                    <article class="post-classic post-minimal"><img src="/img/home-post-1-418x315.jpg" alt="" width="418" height="315"/>
                        <div class="post-classic-title">
                            <h6><a href="standard-post.html">How to Improve Your Lighting at Home</a></h6>
                        </div>
                        <div class="post-meta">
                            <div class="group"><a href="standard-post.html">
                                    <time datetime="2017">Jan.20, 2017</time></a><a class="meta-author" href="standard-post.html">by Brian Williamson</a></div>
                        </div>
                        <div class="post-classic-body">
                            <p>While some find a single lamp in a room adequate, others are now seeing the value of properly, layered lighting. If you’re unsure about how…</p>
                        </div>
                    </article>
                </div>
                <div class="owl-item">
                    <!-- Post classic-->
                    <article class="post-classic post-minimal"><img src="/img/home-post-3-418x315.jpg" alt="" width="418" height="315"/>
                        <div class="post-classic-title">
                            <h6><a href="gallery-post.html">The Answer to a Satisfying Sectional Experience</a></h6>
                        </div>
                        <div class="post-meta">
                            <div class="group"><a href="gallery-post.html">
                                    <time datetime="2017">Jan.20, 2017</time></a><a class="meta-author" href="gallery-post.html">by Brian Williamson</a></div>
                        </div>
                        <div class="post-classic-body">
                            <p>There’s a distinct possibility that you’re now feeling a little disillusioned with the whole furniture-buying experience because you have this large piece…</p>
                        </div>
                    </article>
                </div>
                <div class="owl-item">
                    <!-- Post classic-->
                    <article class="post-classic post-minimal"><img src="/img/home-post-1-418x315.jpg" alt="" width="418" height="315"/>
                        <div class="post-classic-title">
                            <h6><a href="standard-post.html">How to Improve Your Lighting at Home</a></h6>
                        </div>
                        <div class="post-meta">
                            <div class="group"><a href="standard-post.html">
                                    <time datetime="2017">Jan.20, 2017</time></a><a class="meta-author" href="standard-post.html">by Brian Williamson</a></div>
                        </div>
                        <div class="post-classic-body">
                            <p>By improving the physical layout of hospitals and medical facilities, we can enhance and increase safety mechanisms, improve care, and…</p>
                        </div>
                    </article>
                </div>
                <div class="owl-item">
                    <!-- Post classic-->
                    <article class="post-classic post-minimal"><img src="/img/home-post-3-418x315.jpg" alt="" width="418" height="315"/>
                        <div class="post-classic-title">
                            <h6><a href="gallery-post.html">The Answer to a Satisfying Sectional Experience</a></h6>
                        </div>
                        <div class="post-meta">
                            <div class="group"><a href="gallery-post.html">
                                    <time datetime="2017">Jan.20, 2017</time></a><a class="meta-author" href="gallery-post.html">by Brian Williamson</a></div>
                        </div>
                        <div class="post-classic-body">
                            <p>There’s a distinct possibility that you’re now feeling a little disillusioned with the whole furniture-buying experience because you have this large piece…    </p>
                        </div>
                    </article>
                </div>
                <div class="owl-item">
                    <!-- Post classic-->
                    <article class="post-classic post-minimal"><img src="/img/home-post-2-418x315.jpg" alt="" width="418" height="315"/>
                        <div class="post-classic-title">
                            <h6><a href="image-post.html">7 Ways to Add a Custom Look to Your Home</a></h6>
                        </div>
                        <div class="post-meta">
                            <div class="group"><a href="image-post.html">
                                    <time datetime="2017">Jan.20, 2017</time></a><a class="meta-author" href="image-post.html">by Brian Williamson</a></div>
                        </div>
                        <div class="post-classic-body">
                            <p>When we hear the word “custom” we tend to think of the words, “high-end” and “expensive”. This may be true, but in life, we generally get… </p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>--}}

<!-- Reviews --->
{{--<section class="section-lg bg-image context-dark text-center" style="background-image: url(/img/bg-image-2.jpg)">
    <div class="container">
        <h4 class="heading-decorated">WHAT PEOPLE SAY</h4>
        <!-- Owl Carousel-->
        <div class="owl-carousel" data-autoplay="true" data-items="1" data-stage-padding="15" data-loop="true" data-margin="30" data-dots="true" data-nav="true">
            <div class="item">
                <!-- Quote default-->
                <div class="quote-default">
                    <div class="quote-default__image"><img src="/img/deborah-quagmire-120x120.jpg" alt="" width="120" height="120"/>
                    </div>
                    <div class="quote-default__text">
                        <p class="q">I chose Interior Design because of their superior range of design capabilities and their insightful advice during space planning. Their knowledge, experience, and attention to detail have proven invaluable to me in creating a finished project.</p>
                    </div>
                    <p class="quote-default__cite">Jane Smith</p>
                </div>
            </div>
            <div class="item">
                <!-- Quote default-->
                <div class="quote-default">
                    <div class="quote-default__image"><img src="/img/benedict-arnold-120x120.jpg" alt="" width="120" height="120"/>
                    </div>
                    <div class="quote-default__text">
                        <p class="q">Your studio was highly recommended to me. The sensitivity, knowledge, vision and ultimate execution your team brought to the table was tremendous. The renovation of my home could not be the success it has become without your involvement.</p>
                    </div>
                    <p class="quote-default__cite">James Wilson</p>
                </div>
            </div>
            <div class="item">
                <!-- Quote default-->
                <div class="quote-default">
                    <div class="quote-default__image"><img src="/img/testimonials-3-120x120.jpg" alt="" width="120" height="120"/>
                    </div>
                    <div class="quote-default__text">
                        <p class="q">This studio’s professional guidance gave me results that far exceeded my expectations. My clients thoroughly enjoy the fun, relaxing ambiance that the interior design creates. Their amazement began at the opening and have not ceased yet.</p>
                    </div>
                    <p class="quote-default__cite">Kate McMillan</p>
                </div>
            </div>
        </div>
    </div>
</section>--}}

<!-- Clients -->
{{--<section class="section-md text-center bg-default">
    <div class="container">
        <h4 class="heading-decorated">Our Clients</h4>
        <div class="row row-30">
            <div class="col-sm-6 col-md-3">
                <figure class="box-icon-image"><a href="#"><img src="/img/company-1-126x102.png" alt="" width="126" height="102"/></a></figure>
            </div>
            <div class="col-sm-6 col-md-3">
                <figure class="box-icon-image"><a href="#"><img src="/img/company-2-134x102.png" alt="" width="134" height="102"/></a></figure>
            </div>
            <div class="col-sm-6 col-md-3">
                <figure class="box-icon-image"><a href="#"><img src="/img/company-3-132x102.png" alt="" width="132" height="102"/></a></figure>
            </div>
            <div class="col-sm-6 col-md-3">
                <figure class="box-icon-image"><a href="#"><img src="/img/company-4-126x102.png" alt="" width="126" height="102"/></a></figure>
            </div>
            <div class="col-sm-6 col-md-3">
                <figure class="box-icon-image"><a href="#"><img src="/img/company-5-138x102.png" alt="" width="138" height="102"/></a></figure>
            </div>
            <div class="col-sm-6 col-md-3">
                <figure class="box-icon-image"><a href="#"><img src="/img/company-6-143x102.png" alt="" width="143" height="102"/></a></figure>
            </div>
            <div class="col-sm-6 col-md-3">
                <figure class="box-icon-image"><a href="#"><img src="/img/company-7-109x102.png" alt="" width="109" height="102"/></a></figure>
            </div>
            <div class="col-sm-6 col-md-3">
                <figure class="box-icon-image"><a href="#"><img src="/img/company-8-109x102.png" alt="" width="109" height="102"/></a></figure>
            </div>
        </div>
    </div>
</section>--}}

{{ view('templates/footer') }}
