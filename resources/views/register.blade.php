@push('styles')
    <link rel="stylesheet" href="{{ asset('libraries/password/strengthify.min.css') }}">
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
                                <h2 class="heading-decorated">Register Account</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<section class="section section-lg bg-default text-center">
    <div class="container">
        <h3 class="heading-decorated">Register</h3>
        <div class="row justify-content-lg-center">

            <div class="col-lg-10 col-xl-8">

            {{ view('templates/alert') }}

                <!-- RD Mailform -->
                <form class="text-left" method="post" action="{{ url('register') }}" novalidate="novalidate">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-wrap mb-3">
                                <input class="form-input form-control-has-validation" id="contact-captcha-first-name" type="text" name="first_name" value="{{ old('first_name') }}" data-constraints="@Required"><span class="form-validation"></span>
                                <label class="form-label" for="contact-captcha-first-name">First name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-wrap">
                                <input class="form-input form-control-has-validation" id="contact-captcha-last-name" type="text" name="last_name" value="{{ old('last_name') }}" data-constraints="@Required"><span class="form-validation"></span>
                                <label class="form-label" for="contact-captcha-last-name">Last name</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input form-control-has-validation" id="contact-captcha-company" type="text" name="company" value="{{ old('company') }}" data-constraints="@Required"><span class="form-validation"></span>
                        <label class="form-label" for="contact-captcha-company">Company Name</label>
                        <p class="mt-2 text-info">Please make sure this is your valid company name.</p>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input form-control-has-validation" id="contact-captcha-email" type="email" name="email" value="{{ old('email') }}" data-constraints="@Email @Required"><span class="form-validation"></span>
                        <label class="form-label" for="contact-captcha-email">Your e-mail</label>
                    </div>
                    <div class="form-wrap">
                        <input class="form-input form-control-has-validation" id="contact-captcha-phone" type="tel" name="phone" value="{{ old('phone') }}" data-constraints="@Numeric"><span class="form-validation"></span>
                        <label class="form-label" for="contact-captcha-phone">Your phone</label>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input form-control-has-validation" id="contact-captcha-password" type="password" name="password" value="" data-constraints="@Required"><span class="form-validation"></span>
                        <label class="form-label" for="contact-captcha-password">Password</label>
                    </div>

                    <div class="form-wrap">
                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_KEY') }}"></div>
                    </div>

                    <button class="button button-primary mt-3 mr-2" type="submit">Register</button>
                    <a href="{{ url('login') }}" class="button button-primary-outline mr-3">Already registered? Login here</a>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('libraries/password/jquery.strengthify.min.js') }}"></script>
@endpush
{{ view('templates/footer') }}

<script type="text/javascript">
    $('#contact-captcha-password').strengthify({
        zxcvbn: 'https://cdn.rawgit.com/dropbox/zxcvbn/master/dist/zxcvbn.js'
    });
</script>
