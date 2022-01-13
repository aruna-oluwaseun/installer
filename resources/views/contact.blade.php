{{ view('templates/header') }}

<section class="text-center">
    <section class="section parallax-container" data-parallax-img="{{ asset('img/stonewrap-parallax.jpg') }}"><div class="material-parallax parallax"><img src="{{ asset('img/stonewrap-parallax.jpg') }}" alt="" style="display: block; transform: translate3d(-50%, 160px, 0px);"></div>
        <div class="parallax-content parallax-header parallax-light">
            <div class="parallax-header__inner">
                <div class="parallax-header__content">
                    <div class="container">
                        <div class="row justify-content-sm-center">
                            <div class="col-md-10 col-xl-8">
                                <h2 class="heading-decorated">Benefits</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<!-- Our Services-->
<section class="section-md bg-default ">
    <div class="container">

        {{ view('templates.alert') }}

        <div class="row row-50">
            <div class="col-md-5 col-lg-4">
                <h4 class="heading-decorated">Contact Details</h4>
                <ul class="list-sm contact-info">
                    {{--<li>
                        <dl class="list-terms-inline">
                            <dt>Address</dt>
                            <dd>{{ env('APP_ADDRESS') }}</dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="list-terms-inline">
                            <dt>Phones</dt>
                            <dd>
                                <ul class="list-semicolon">
                                    <li><a href="tel:{{ env('APP_PHONE') }}">{{ env('APP_PHONE') }}</a></li>
                                </ul>
                            </dd>
                        </dl>
                    </li>--}}
                    <li>
                        <dl class="list-terms-minimal">
                            <dt>E-mail</dt>
                            <dd><a class="link-primary" href="mailto:{{ env('GENERAL_EMAIL') }}">{{ env('GENERAL_EMAIL') }}</a></dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="list-terms-inline">
                            <dt>We are open</dt>
                            <dd>Mn-Fr: 9am - 5pm</dd>
                        </dl>
                    </li>
                    <li>
                        <ul class="list-inline-sm">
                            <li><a class="icon-sm fa-facebook novi-icon icon" href="{{ env('FACEBOOK')  }}"></a></li>
                            <li><a class="icon-sm fa-twitter novi-icon icon" href="{{ env('TWITTER') }}"></a></li>
                            <li><a class="icon-sm fa-instagram novi-icon icon" href="{{ env('INSTAGRAM') }}"></a></li>
                            {{--<li><a class="icon-sm fa-google-plus novi-icon icon" href="#"></a></li>
                            <li><a class="icon-sm fa-vimeo novi-icon icon" href="#"></a></li>
                            <li><a class="icon-sm fa-youtube novi-icon icon" href="#"></a></li>
                            <li><a class="icon-sm fa-pinterest-p novi-icon icon" href="#"></a></li>--}}
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="heading-decorated">Get in Touch</h4>
                <!-- RD Mailform-->
                <form class="rd-mailform_style-1" method="post" action="{{ url('contact') }}" novalidate="novalidate">
                    @csrf
                    <div class="form-wrap form-wrap_icon linear-icon-man">
                        <input class="form-input form-control-has-validation" id="contact-name" type="text" name="name" value="{{ old('name') }}" data-constraints="@Required"><span class="form-validation"></span>
                        <label class="form-label rd-input-label" for="contact-name">Your name</label>
                    </div>
                    <div class="form-wrap form-wrap_icon linear-icon-envelope">
                        <input class="form-input form-control-has-validation" id="contact-email" type="email" name="email" value="{{ old('email') }}" data-constraints="@Email @Required"><span class="form-validation"></span>
                        <label class="form-label rd-input-label" for="contact-email">Your e-mail</label>
                    </div>
                    <div class="form-wrap form-wrap_icon linear-icon-feather">
                        <textarea class="form-input form-control-has-validation" id="contact-message" name="message" value="{{ old('message') }}" data-constraints="@Required"></textarea><span class="form-validation"></span>
                        <label class="form-label rd-input-label" for="contact-message">Your message</label>
                    </div>
                    <div class="form-wrap">
                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}"></div>
                    </div>
                    <button class="button button-primary" type="submit">send</button>
                </form>
            </div>
        </div>
    </div>
</section>


{{ view('templates/footer') }}
