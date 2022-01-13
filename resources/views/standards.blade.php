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
                                <h2 class="heading-decorated">Standards</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<section class="section section-lg bg-default ">
    <div class="container">
        <h3 class="heading-decorated">{{ env('APP_NAME') }} Standards</h3>
        <div class="p-4">


            {{ view('templates/alert') }}


            <p class="mt-2">At {{ env('APP_NAME') }} we strive for high industry standards and therefore set values for all our members to adhere by. Our values are as follows:</p>

            <ol class="list-ordered mb-3 pl-3">
                <li >Respect customers &amp; other tradespersons</li>
                <li >&nbsp;Professional conduct &amp; Safety at work</li>
                <li >Communicate effectively with clients</li>
                <li >Gain honest reviews</li>
                <li >Resolve any issues&nbsp;</li>
                <li >Clear &amp; Concise quotes, payments &amp; contracts&nbsp;</li>
            </ol>

            <p class="mt-2">These values apply to all members including directions/company owners, subcontractors, employees and anyone who maybe involved with works.&nbsp;</p>
            <p class="mt-2">Failure to comply with any of our standards and/or terms &amp; conditions will results in review of the tradespersons membership. This could lead to possible suspension or even termination of membership.&nbsp;</p>
            <p class="mt-2"><strong>Respect customers &amp; other tradespersons</strong></p>
            <p class="mt-2">Members agree to:</p>
            <ul class="list-marked mb-3 pl-3">
                <li >Treat everyone with courtesy, politeness &amp; kindness</li>
                <li >Be respectful to customers, their property &amp; belongings</li>
                <li >Will not act in a violent manner whether verbally or physically</li>
                <li >Respect customer privacy &amp; confidentiality. Any information gain from a customer remains private and confidential.&nbsp;</li>
                <li >Act with Honesty &amp; integrity&nbsp;</li>
            </ul>
            <p class="mt-2"><br></p>
            <p class="mt-2"><strong>Professional Conduct &amp; Safety at Work</strong></p>
            <p class="mt-2">Members agree to:</p>
            <ul class="list-marked mb-3 pl-3">
                <li >All members will agree to the {{ env('APP_NAME') }} membership pledge upon sign up</li>
                <li >Adhere to COVID guidelines found on the government website gov.uk&nbsp;</li>
                <li >Keep working environment safe during &amp; after works have been carried out</li>
                <li >Comply with current Health &amp; Safety legislation&nbsp;</li>
                <li >Only carry out works within your professional ability</li>
                <li >Goods supplied to customers must be fit for purpose, comply with UK legislation and meet customer requirements</li>
                <li >Educate customers effectively in the products being supplied to enable them to make an educated decision. Act honestly in regards to pros &amp; cons of all products used.&nbsp;</li>
                <li >Do not conduct door to door sales &amp; cold calling&nbsp;</li>
            </ul>


            <p class="mt-2"><strong>Communicate effectively with clients</strong></p>
            <p class="mt-2">Members agree to:</p>
            <ul class="list-marked mb-3 pl-3">
                <li >Educate clients on products &amp;/or services on offer</li>
                <li >Give guidance on aftercare</li>
                <li >Communicate times &amp; dates for work start dates &amp;/or quotations</li>
                <li >Keep customers informed if you cannot attend due to other works going over schedule&nbsp;</li>
                <li >Honest information in regards to length of works, working dates &amp; timings</li>
                <li >Inform customers if they cannot carry out works&nbsp;</li>
                <li >Keep all appointment bookings. If unable to make original time or date they must contact the customer to re-schedule</li>
                <li >Inform customers of any charges for quotation or call outs</li>
                <li >No hidden fees&nbsp;</li>
                <li >Respond to all customer communication in a professional and timely manner.&nbsp;</li>
                <li >Refer a customer back to Fedca.co.uk if they cannot carry out a contract that they &nbsp;have booked, so they may assist the customer in finding another installer</li>
                <li >Return all phone messages promptly&nbsp;</li>
                <li >Keep the customer informed throughout the works</li>
            </ul>


            <p class="mt-2"><strong>Gain honest reviews</strong></p>
            <p class="mt-2">Members agree to:</p>
            <ul class="list-marked mb-3 pl-3">
                <li >Never attempt to gain false reviews</li>
                <li >Request a review from every customer&nbsp;</li>
                <li >Not exert pressure on a customer to leave a review</li>
                <li >Not threaten customers who leave negative feedback&nbsp;</li>
                <li >Report any feedback they believe to be unjust&nbsp;</li>
                <li >Not provide false/fake references as this is a serious breach of {{ env('APP_NAME') }} standards&nbsp;</li>
                <li >Do not offer to post feedback for customers&nbsp;</li>
            </ul>
            <p class="mt-2"><br></p>

            <p class="mt-2"><strong>Resolve any issues</strong></p>

            <p class="mt-2">Members agree to:</p>
            <ul class="list-marked mb-3 pl-3">
                <li >Attempt to resolve any issues within reasonable parameters of what is expected for the products installed&nbsp;</li>
                <li >Not to ignore any issues raised by a customer</li>
                <li >Adhere to contractual agreements/obligations</li>
                <li >Report any prolonged complaints or disputes to the {{ env('APP_NAME') }} support network</li>
                <li >Reply to customer complaints received promptly and without abuse or confrontation&nbsp;</li>
            </ul>


            <p class="mt-2"><strong>Clear &amp; Concise quotes, payments &amp; contracts&nbsp;</strong></p>
            <p class="mt-2">We ask that all members provide clear &amp; honest documentation for all jobs.&nbsp;</p>
            <p class="mt-2">Members agree to:</p>
            <ul class="list-marked mb-3 pl-3">
                <li >Provide quotations that are within respectable guidelines for the works being carried out.&nbsp;</li>
                <li >Be specific and set clear &amp; detailed quotations&nbsp;</li>
                <li >Agree in writing any changes to agreed quotations/contracts</li>
                <li >Terms &amp; conditions to be provided to customers &amp; contracts in place.&nbsp;</li>
                <li >14 day cooling off period to be provided if applicable (in accordance with the consumer rights act 2015)</li>
                <li >Invoices to be supplied to customers with payment terms</li>
                <li >For contracts give customers time to review prior to proceeding&nbsp;</li>
                <li >Full payment not to be taken until works completed. Full payment terms to be decided by the contractor.&nbsp;</li>
                <li >Payments should not be demanded in cash&nbsp;</li>
            </ul>


        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}
