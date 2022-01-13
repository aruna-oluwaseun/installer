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
                                <h2 class="heading-decorated">Forgot Password</h2>
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
        <h3 class="heading-decorated">Enter Email</h3>
        <div class="row justify-content-lg-center">

            <div class="col-lg-8 col-xl-6">

            {{ view('templates/alert') }}

                <!-- RD Mailform -->
                <form class="text-left" method="post" action="{{ route('password.email') }}" novalidate="novalidate">
                    @csrf
                    <div class="form-wrap">
                        <input class="form-input form-control-has-validation" id="contact-captcha-email" type="email" name="email" value="{{ old('email') }}" data-constraints="@Email @Required"><span class="form-validation"></span>
                        <label class="form-label" for="contact-captcha-email">Your e-mail</label>
                    </div>

                    <button class="button button-primary mr-2" type="submit">Reset password</button>
                    <a href="{{ url('register') }}" class="button button-primary-outline mr-3">Login</a>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}
