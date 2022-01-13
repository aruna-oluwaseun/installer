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
                <form method="post" action="{{ url('account/payment-methods') }}">
                    @csrf
                    @method('update')
                    <h4 class="mb-4">Payment Methods
                        <a href="#addPaymentMethod" data-toggle="modal" data-dismiss="modal" class="button button-primary mt-3 mt-md-0  float-md-right">{{ $payment_methods ? 'Update Payment Method' : 'Add Payment Method' }}</a>
                    </h4>
                    <?php if($payment_methods) : ?>
                        <?php
                            $method = $payment_methods;
                        ?>
                        <table class="table">
                            <thead>
                                <th>Type</th>
                                <th>Exp</th>
                                <th>Last Four</th>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{ ucfirst($method->card->brand) }}</td>
                                    <td>{{ $method->card->exp_month.'/'.$method->card->exp_year }}</td>
                                    <td>{{ $method->card->last4 }}</td>
                                </tr>

                            </tbody>
                        </table>

                    <?php else : ?>

                    <div class="alert alert-info">
                        You do not have any payment methods attached to your account, <a href="#addPaymentMethod" data-toggle="modal" data-dismiss="modal" class="text-info">Add Payment method</a>
                    </div>
                    <p class="text-muted mt-3">Nothing will be charged until you sign up to a package.</p>

                    <?php endif; ?>
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
                <h5>Add new payment method</h5>
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
                        <button type="button" class="button button-primary mt-0" id="card-button" data-secret="{{ $intent->client_secret }}">
                            Save
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

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
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

                cardButton.innerHTML = "Success...please wait";
                setTimeout(function() {
                    $('#payment-form').submit();
                },800);

            }
        });
    </script>
@endpush
{{ view('templates/footer') }}

<script type="text/javascript">

</script>
