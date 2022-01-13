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
                                <h2 class="heading-decorated">Subscribe</h2>
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
                <form id="subscribe-form" method="post" action="{{ route('subscribe',[$price->id, slug($package->title)]) }}">
                    @csrf

                    <h4 class="mb-3">
                        You have chosen our <span class="text-primary">{{ $package->title }}</span> package
                    </h4>
                    <?php if($package->description) : ?>
                    <p class="mt-0">You subscribing to our {{ $package->title }} package</p>
                    <?php endif; ?>

                    <?php if($package->trial_amount && $package->trial_interval) : ?>
                        <?php
                            $dt = new DateTime();
                            $dt->modify('+ '.$package->trial_amount.' '.$package->trial_interval);
                        ?>
                       <div class="alert alert-success">
                           {{ $package->trial_amount }} {{ ucfirst($package->trial_interval) }} Free : This means you will not be charged until {{ short_date($dt->format('Y-m-d')) }}
                       </div>
                    <?php endif; ?>

                    <p class="mt-0">You subscribing to our {{ $package->title }} package. Please review the details below.</p>
                    <?php if($package->features->count()) : ?>
                    <p>The <strong>{{ $package->title }}</strong> package has the following features : </p>
                    <ul class="list-marked">
                        <?php foreach($package->features as $feature) : ?>
                            <li>{{ $feature->title }}</li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>

                    <div class="card card-bordered mt-4 mb-4">
                        <div class="card-body">
                            <h3>£{{ number_format($price->cost) }} / {{ $price->billing_period }}</h3>
                        </div>
                        <div class="card-footer">
                            You will be billed to your default payment method <strong>{{ $price->billing_period }}</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <p class="mt-0 text-muted">You have 14 days to cancel your subscription{{ ($package->trial_amount && $package->trial_interval) ? ' before the end of the free trial period' : ''}}.</p>
                        <input name="agree_to_terms" id="agree-to-terms" type="checkbox" value="1">
                        <label class="custom-control-label" for="agree-to-terms"> To proceed you must agree to our : <a href="{{ route('terms') }}" target="_blank">terms and conditions</a>, <a href="{{ route('terms-of-sale') }}" target="_blank">subscription terms of sale</a> and <a href="{{ route('conduct', ['business']) }}" target="_blank">{{ env('APP_NAME') }} code of conduct</a></label>
                    </div>

                    <button id="subscribe-btn" type="submit" class="btn btn-primary" disabled>Subscribe to package</button>

                </form>
            </div>

            <!-- sidemenu -->
            <div class="col-lg-5 col-xl-4 section-divided__aside section__aside-left">
                {{ view('account.templates.side-menu') }}
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addPaymentMethod" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog_custom">
        <!-- Modal content-->
        <div class="modal-dialog__inner" style="padding-top: 20px;">
            <button class="close" type="button" data-dismiss="modal"></button>
            <div class="modal-dialog__content">
                <h5>We just need a payment method</h5>
                <hr>
                <!-- RD Mailform-->
                <form id="payment-form" class="rd-mailform_responsive" method="post" action="{{ url('account/payment-method') }}" novalidate="novalidate">
                    @csrf
                    <div class="stripe-response">
                        <!-- stripe card here -->
                    </div>

                    <div class="form-wrap">
                        <label>Card Holder Name</label>
                        <input id="card-holder-name" class="form-input" type="text">
                    </div>


                    <!-- Stripe Elements Placeholder -->
                    <div class="mt-3">
                        <div id="card-element"></div>
                    </div>

                    <div class="mt-5">
                        <button type="button" class="button button-primary mt-0" id="card-button" data-secret="{{ isset($intent) ? $intent->client_secret : '' }}">
                            Save and Subscribe
                        </button>
                        <div class="float-right">
                            <img src="{{ asset('img/card-icons/Powered by Stripe - black.png') }}" alt="Payments are securely powered by Stripe" width="120">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php if(isset($intent) && $intent != null) : ?>
    <div id="card-required"></div>
<?php endif; ?>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>

        $('#agree-to-terms').on('click', function() {
            if($(this).prop('checked'))
            {
                $('#subscribe-btn').removeAttr('disabled');
            }
            else
            {
                $('#subscribe-btn').attr('disabled','disabled');
            }
        });

        // Check if card is required
        $(document).on('submit','#subscribe-form', function (e) {
            //e.preventDefault();
            if($('#card-required').length)
            {
                e.preventDefault();
                $('#addPaymentMethod').modal('toggle');
            }
        });

        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        let elements = stripe.elements();
        let cardElement = elements.create('card');

        $('#addPaymentMethod').on('shown.bs.modal', function (e) {
            elements = stripe.elements();
            cardElement = elements.create('card');
            cardElement.mount('#card-element');
        });

        $('#addPaymentMethod').on('hidden.bs.modal', function(e) {
            cardElement.destroy();
        });

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            cardButton.innerHTML = "Please wait...";

            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error adding card',
                    text: error.message ? error.message : 'There was an error verifying the card.',
                    //footer: '<a href>Why do I have this issue?</a>'
                });

                cardButton.innerHTML = "Save";
            } else {
                // The card has been verified successfully...
                $('.stripe-response').html('<input type="hidden" name="payment_method" value="' + setupIntent.payment_method + '">');

                cardButton.innerHTML = "Saving card to account...please wait";

                $.ajax({
                    url: '{{ url('account/payment-method') }}',
                    method : 'post',
                    data : $('#payment-form').serialize(),
                    success: function(response) {

                        if(response.success)
                        {
                            cardButton.innerHTML = "Card saved...subscribing to package.";

                            $('#card-required').remove();

                            setTimeout(function () {
                                $('#subscribe-form').submit();
                            }, 1000)
                        }

                        else
                        {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message ? response.message : 'An error occurred saving your card, please try again.',
                                //footer: '<a href>Why do I have this issue?</a>'
                            });
                        }
                    },
                    error: function(XHR, textStatus, error) {
                        if(XHR.status === 422) {
                            var response = XHR.responseJSON;
                            var errors = response.errors;
                            var message = 'You have errors in your form.';
                           /* $.each( errors, function( key, value ) {
                                $('#modalCreate [name="'+ key +'"]').parent().append('<span id="'+ key +'-error" class="invalid">This field is required.</span>');
                                message += value;
                            });*/
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: message ? message : 'Your session may have expired, please re-fresh your page and try again.',
                            //footer: '<a href>Why do I have this issue?</a>'
                        });

                        cardButton.innerHTML = "Save and Subscribe";
                    }
                })
            }
        });
    </script>
@endpush
{{ view('templates/footer') }}

<script type="text/javascript">

</script>
