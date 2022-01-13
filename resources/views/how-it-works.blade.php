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
                                <h2 class="heading-decorated">How it works</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<section class="section section-lg bg-default ">
    <div class="container text-center">
        <h3 class="heading-decorated">How it works</h3>
        <div class="p-4">

            {{ view('templates/alert') }}

            <div class="row mb-4 mt-4">

                <div class="col-sm-6">
                    <a href="#look-for-trade" class="card card-link active">
                        <div class="card-body" style="padding: 3.25rem;">
                            <h4>I am looking for Tradesperson</h4>
                        </div>
                    </a>

                </div>

                <div class="col-sm-6">
                    <a href="#i-am-trade" class="card card-link">
                        <div class="card-body" style="padding: 3.25rem;">
                            <h4>Trade membership</h4>
                        </div>

                    </a>
                </div>

            </div>

            <div class="row info" id="look-for-trade">
                <div class="col-md-6 text-left">
                    <h5>I am looking for Tradesperson</h5>

                    <ol class="list-ordered pl-3">
                        <li>Click <a href="{{ url('find-installer') }}" target="_blank">find an installer</a></li>
                        <li>Type in your postcode & service required: Alternatively search company name</li>
                        <li>Click on a company for contact information</li>
                        <li>Advisor: Check if they are verified, look out for this icon <a href="{{ url('verified-company') }}"><span data-toggle="tooltip" data-placement="top" title="Verified Company"><img src="{{ asset('img/icon-verified.png') }}" width="16" alt="" ></span></a>
                        </li>
                        <li>Message directly using contact form or click Call or email now</li>
                    </ol>
                </div>
            </div>


            <div class="row info" id="i-am-trade" style="display: none;">
                <div class="col-md-6 text-left">
                    <h5>Trade membership</h5>

                    <ol class="list-ordered pl-3">
                        <li>Sign up by <a href="{{ url('register') }}" target="_blank">creating an account</a></li>
                        <li>Fill in all account details</li>
                        <li>Become a verified company by uploading public liability and adding 3 references <a href="{{ url('verified-company') }}"><span data-toggle="tooltip" data-placement="top" title="Verified Company Badge"><img src="{{ asset('img/icon-verified.png') }}" width="16" alt="" ></span></a></li>
                        <li>Personalise profile</li>
                        <li>Sit & Wait for customer to contact</li>
                    </ol>
                </div>
            </div>

        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}
<script type="text/javascript">

    $('.card-link').on('click', function() {
        $('.card-link').removeClass('active');
        $('.info').hide();

        $(this).addClass('active');
        $($(this).attr('href')).show();
    });

</script>
