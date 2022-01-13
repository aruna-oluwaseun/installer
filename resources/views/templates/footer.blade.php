<!-- Page Footer -->
<section class="pre-footer-corporate bg-black">
    <div class="container">
        <div class="row justify-content-sm-center justify-content-lg-start row-30 row-md-60">
            <div class="col-sm-10 col-md-6 col-lg-10 col-xl-3"><a href="/"><img src="{{ asset('img/Fedca-Decorative-Coatings-Logo-Dark.jpg') }}" alt="Fedca Decorative Coatings Association" width="232" height="68"/></a>
                <p>Fedca has a whole host of vetted installers to make sure you have the job done the right way the first time.</p>
                <img src="{{ asset('img/card-icons/Powered by Stripe - white.png') }}" alt="Payments are securely powered by Stripe" width="120">
            </div>
            <div class="col-sm-10 col-md-6 col-lg-3 col-xl-3">
                <h6>Navigation</h6>
                <ul class="list-xxs list-primary">
                    <li><a href="{{ url('how-it-works') }}">How it works</a></li>
                    <li><a href="{{ url('register') }}">Register</a></li>
                    <li><a href="{{ url('find-installer') }}">Find Installer</a></li>
                    <li><a href="{{ url('contact') }}">Contacts</a></li>
                    <li><a href="{{ url('code-of-conduct') }}">Code of conduct</a></li>
                    <li><a href="{{ url('standards') }}">{{ env('APP_NAME') }} Standards</a></li>
                </ul>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-4 col-xl-3">
                <h6>Contacts</h6>
                <ul class="list-xs">
                    {{--<li>
                        <dl class="list-terms-minimal">
                            <dt>Address</dt>
                            <dd>{{ env('APP_ADDRESS') }}</dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="list-terms-minimal">
                            <dt>Phones</dt>
                            <dd>
                                <ul class="list-semicolon">
                                    <li><a href="tel:#">{{ env('APP_PHONE') }}</a></li>
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
                        <dl class="list-terms-minimal">
                            <dt>We are open</dt>
                            <dd>Mn-Fr: 9 am-5 pm</dd>
                        </dl>
                    </li>
                </ul>
            </div>
            {{--<div class="col-sm-10 col-md-6 col-lg-5 col-xl-3">
                <div class="google-map-footer">
                    <div class="google-map-container" data-zoom="15" data-center="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-styles="[{&quot;featureType&quot;:&quot;all&quot;,&quot;elementType&quot;:&quot;labels.text.fill&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:36},{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:40}]},{&quot;featureType&quot;:&quot;all&quot;,&quot;elementType&quot;:&quot;labels.text.stroke&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;},{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:16}]},{&quot;featureType&quot;:&quot;all&quot;,&quot;elementType&quot;:&quot;labels.icon&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;administrative&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:20}]},{&quot;featureType&quot;:&quot;administrative&quot;,&quot;elementType&quot;:&quot;geometry.stroke&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:17},{&quot;weight&quot;:1.2}]},{&quot;featureType&quot;:&quot;administrative&quot;,&quot;elementType&quot;:&quot;labels&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;administrative.country&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;administrative.country&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;administrative.country&quot;,&quot;elementType&quot;:&quot;labels.text&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;administrative.province&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;administrative.locality&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;},{&quot;saturation&quot;:&quot;-100&quot;},{&quot;lightness&quot;:&quot;30&quot;}]},{&quot;featureType&quot;:&quot;administrative.neighborhood&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;administrative.land_parcel&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;landscape&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;},{&quot;gamma&quot;:&quot;0.00&quot;},{&quot;lightness&quot;:&quot;74&quot;}]},{&quot;featureType&quot;:&quot;landscape&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:20}]},{&quot;featureType&quot;:&quot;landscape.man_made&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;lightness&quot;:&quot;3&quot;}]},{&quot;featureType&quot;:&quot;poi&quot;,&quot;elementType&quot;:&quot;all&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:21}]},{&quot;featureType&quot;:&quot;road&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:17}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;geometry.stroke&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:29},{&quot;weight&quot;:0.2}]},{&quot;featureType&quot;:&quot;road.arterial&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:18}]},{&quot;featureType&quot;:&quot;road.local&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:16}]},{&quot;featureType&quot;:&quot;transit&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:19}]},{&quot;featureType&quot;:&quot;water&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#000000&quot;},{&quot;lightness&quot;:17}]}]">
                        <div class="google-map"></div>
                        <ul class="google-map-markers">
                            <li data-location="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-description="9870 St Vincent Place, Glasgow" data-icon="images/gmap_marker.png" data-icon-active="images/gmap_marker_active.png"></li>
                        </ul>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
</section>

<footer class="footer-corporate bg-gray-darkest">
    <div class="container">
        <div class="footer-corporate__inner">
            <p class="rights"><span>Fedca Limited</span><span>&nbsp;</span><span class="copyright-year"></span>. All Rights Reserved.<a href="{{ route('terms') }}">Terms of Use</a> and <a href="{{ route('privacy') }}">Privacy Policy</a></p>
            <ul class="list-inline-xxs">
                <li><a class="icon icon-xxs icon-gray-darker fa fa-facebook" href="{{ env('FACEBOOK') }}"></a></li>
                <li><a class="icon icon-xxs icon-gray-darker fa fa-twitter" href="{{ env('TWITTER') }}"></a></li>
                <li><a class="icon icon-xxs icon-gray-darker fa fa-instagram" href="{{ env('INSTAGRAM') }}"></a></li>
                {{--<li><a class="icon icon-xxs icon-gray-darker fa fa-google-plus" href="#"></a></li>
                <li><a class="icon icon-xxs icon-gray-darker fa fa-vimeo" href="#"></a></li>
                <li><a class="icon icon-xxs icon-gray-darker fa fa-youtube" href="#"></a></li>
                <li><a class="icon icon-xxs icon-gray-darker fa fa-pinterest" href="#"></a></li>--}}
            </ul>
        </div>
    </div>
</footer>
</div>

<!-- Modal login window-->{{--
<div class="modal fade" id="modalLogin" role="dialog">
    <div class="modal-dialog modal-dialog_custom">
        <!-- Modal content-->
        <div class="modal-dialog__inner">
            <button class="close" type="button" data-dismiss="modal"></button>
            <div class="modal-dialog__content">
                <h5>Login Form</h5>
                <!-- RD Mailform-->
                <form class="rd-mailform rd-mailform_responsive">
                    <div class="form-wrap form-wrap_icon linear-icon-envelope">
                        <input class="form-input" id="modal-login-email" type="email" name="email" data-constraints="@Email @Required">
                        <label class="form-label" for="modal-login-email">Your e-mail</label>
                    </div>
                    <div class="form-wrap form-wrap_icon linear-icon-lock">
                        <input class="form-input" id="modal-login-password" type="password" name="password" data-constraints="@Required">
                        <label class="form-label" for="modal-login-password">Your password</label>
                    </div>
                    <button class="button button-primary" type="submit">Login</button>
                </form>
                <ul class="list-small">
                    <li><a href="#">Forgot your username?</a></li>
                    <li><a href="#">Forgot your password?</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>--}}

<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>
<!-- Javascript-->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/core.min.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/helpers.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>
<script>
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
                "background": "#aa0000",
                "text": "#ffdddd"
            },
            "button": {
                "background": "#ff0000"
            }
        },
        "theme": "edgeless",
        "position": "bottom-right",
        "content": {
            "href": "{{ url('cookie-policy') }}"
        }
    });
</script>
</body>
</html>
