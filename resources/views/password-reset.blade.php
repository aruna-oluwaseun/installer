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
                                <h2 class="heading-decorated">Reset Password</h2>
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
        <h3 class="heading-decorated">Reset Password</h3>
        <div class="row justify-content-lg-center">

            <div class="col-lg-8 col-xl-6">

            {{ view('templates/alert') }}

                <!-- RD Mailform -->
                <form class="text-left" method="post" action="{{ route('password.update') }}" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-wrap">
                        <input class="form-input form-control-has-validation" id="contact-captcha-email" type="email" name="email" value="{{ old('email') }}" data-constraints="@Email @Required"><span class="form-validation"></span>
                        <label class="form-label" for="contact-captcha-email">Your e-mail</label>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input form-control-has-validation" id="contact-captcha-password" type="password" name="password" value="" data-constraints="@Required"><span class="form-validation"></span>
                        <label class="form-label" for="contact-captcha-password">New password</label>
                    </div>

                    <div class="form-wrap">
                        <input class="form-input form-control-has-validation" type="password" name="password_confirmation" value="" data-constraints="@Required"><span class="form-validation"></span>
                        <label class="form-label" for="contact-captcha-password">Confirm new password</label>
                    </div>

                    <button class="button button-primary mr-2" type="submit">Change Password</button>
                    <a href="{{ url('register') }}" class="button button-primary-outline mr-3">Login</a>
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
