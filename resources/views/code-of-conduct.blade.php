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
                                <h2 class="heading-decorated">Code of Conduct</h2>
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
        <h3 class="heading-decorated">{{ env('APP_NAME') }} code of conduct</h3>
        <div class="p-4">

            {{ view('templates/alert') }}


                <p class="mt-2"><strong>Members pledge to their Fedca.co.uk customers: I/we agree to:&nbsp;</strong></p>
                <p class="mt-2"><strong>1.0 Respect customers &amp; other tradespersons</strong></p>
                <p class="mt-2">Members agree to:</p>
                <ul class="list-marked mb-3 pl-3">
                    <li>Treat everyone with courtesy, politeness &amp; kindness</li>
                    <li>Be respectful to customers, their property &amp; belongings</li>
                    <li>Will not act in a violent manner whether verbally or physically</li>
                    <li>Respect customer privacy &amp; confidentiality. Any information gained from a customer remains private and confidential.&nbsp;</li>
                    <li>Act with Honesty &amp; integrity&nbsp;</li>
                </ul>
                <p class="mt-2"><strong>2.0 Professional Conduct &amp; Safety at Work</strong></p>
                <p class="mt-2">Members agree to:</p>
                <ul class="list-marked mb-3 pl-3">
                    <li>All members will agree to the FEDCA membership pledge upon sign up</li>
                    <li>Adhere to COVID guidelines found on the government website gov.uk&nbsp;</li>
                    <li>Keep working environment safe during &amp; after works have been carried out</li>
                    <li>Comply with current Health &amp; Safety legislation&nbsp;</li>
                    <li>Only carry out works within your professional ability</li>
                    <li>Goods supplied to customers must be fit for purpose, comply with UK legislation and meet customer requirements</li>
                    <li>Educate customers effectively in the products being supplied to enable them to make an educated decision. Act honestly in regards to pros &amp; cons of all products used.&nbsp;</li>
                    <li>Do not conduct door to door sales &amp; cold calling&nbsp;</li>
                </ul>
                <p class="mt-2"><br></p>
                <p class="mt-2"><strong>3.0 Communicate effectively with clients</strong></p>
                <p class="mt-2">Members agree to:</p>
                <ul class="list-marked mb-3 pl-3">
                    <li>Educate clients on products &amp;/or services on offer</li>
                    <li>Give guidance on aftercare</li>
                    <li>Communicate times &amp; dates for work start dates &amp;/or quotations</li>
                    <li>Keep customers informed if you cannot attend due to other works going over schedule&nbsp;</li>
                    <li>Honest information in regards to length of works, working dates &amp; timings</li>
                    <li>Inform customers if they cannot carry out works&nbsp;</li>
                    <li>Keep all appointment bookings. If unable to make original time or date they must contact the customer to re-schedule</li>
                    <li>Inform customers of any charges for quotation or call outs</li>
                    <li>No hidden fees&nbsp;</li>
                    <li>Respond to all customer communication in a professional and timely manner.&nbsp;</li>
                    <li>Refer a customer back to Fedca.co.uk if I/we cannot carry out a contract that I/we have booked, so they may assist the customer in finding another installer</li>
                    <li>Return all phone messages promptly&nbsp;</li>
                    <li>Keep the customer informed throughout the works</li>
                </ul>
                <p class="mt-2"><br></p>
                <p class="mt-2"><strong>4.0 Gain honest reviews</strong></p>
                <p class="mt-2">Members agree to:</p>
                <ul class="list-marked mb-3 pl-3">
                    <li>Never attempt to gain false reviews</li>
                    <li>Request a review from every customer&nbsp;</li>
                    <li>Not exert pressure on a customer to leave a review</li>
                    <li>Not threaten customers who leave negative feedback&nbsp;</li>
                    <li>Report any feedback they believe to be unjust&nbsp;</li>
                    <li>Not provide false/fake references as this is a serious breach of FEDCA standards&nbsp;</li>
                    <li>Do not offer to post feedback for customers&nbsp;</li>
                </ul>
                <p class="mt-2"><strong>5.0 Resolve any issues</strong></p>
                <p class="mt-2">Members agree to:</p>
                <ul class="list-marked mb-3 pl-3">
                    <li>Attempt to resolve any issues within reasonable parameters of what is expected for the products installed&nbsp;</li>
                    <li>Not to ignore any issues raised by a customer</li>
                    <li>Adhere to contractual agreements/obligations</li>
                    <li>Report any prolonged complaints or disputes to the FEDCA support network</li>
                    <li>Reply to customer complaints received promptly and without abuse or confrontation&nbsp;</li>
                </ul>
                <p class="mt-2"><br></p>
                <p class="mt-2"><strong>6.0 Clear &amp; Concise quotes, payments &amp; contracts&nbsp;</strong></p>
                <p class="mt-2">We ask that all members provide clear &amp; honest documentation for all jobs.&nbsp;</p>
                <p class="mt-2">Members agree to:</p>
                <ul class="list-marked mb-3 pl-3">
                    <li>Provide quotations that are within respectable guidelines for the works being carried out.&nbsp;</li>
                    <li>Be specific and set clear &amp; detailed quotations&nbsp;</li>
                    <li>Agree in writing any changes to original agreed quotations/contracts</li>
                    <li>Terms &amp; conditions to be provided to customers &amp; contracts in place.&nbsp;</li>
                    <li>14 day cooling off period to be provided if applicable (in accordance with the consumer rights act 2015)</li>
                    <li>Invoices to be supplied to customers with payment terms</li>
                    <li>For contracts give customers time to review prior to proceeding&nbsp;</li>
                    <li>Full payment not to be taken until works completed. Full payment terms to be decided by the contractor.&nbsp;</li>
                    <li>Payments should not be demanded in cash&nbsp;</li>
                </ul>
                <p class="mt-2"><br></p>
                <p class="mt-2"><strong>Members pledge to Fedca.co.uk (Fedca Limited): I/we agree to (or understand that):</strong></p>
                <p class="mt-2"><br></p>
                <ul class="list-marked mb-3 pl-3">
                    <li>To ask politely for customers to leave reviews on my installer profile on fedca.co.uk&nbsp;</li>
                    <li>Be courteous and respectful of all employees of FEDCA</li>
                    <li>Supply FEDCA with a copy of my public liability insurance certification and forward renewal documentation in good time. If insurance documents expire membership will be temporarily suspended until renewal documentation has been provided &amp; approved.&nbsp;</li>
                    <li>Return all proof of renewal documentation within 5 working days of renewal to allow adequate time for administration&nbsp;</li>
                    <li>Pay membership on time&nbsp;</li>
                    <li>If circumstances change that affects payment of membership such as change of bank details I will inform &nbsp;Fedca.co.uk (Fedca Limited) immediately.&nbsp;</li>
                    <li>Update contact details promptly when required</li>
                    <li>Return all messages left by <a href="mailto:info@fedca.co.uk">info@fedca.co.uk</a> or other Fedca methods of contact&nbsp;</li>
                    <li>Never carry out works outside my certification.&nbsp;</li>
                    <li>For any works that require certified tradespersons such as gas &amp; electrics I will not undertake this work myself (unless qualified). If there is need for such persons &nbsp;I will use a qualified company or individual as a sub-contractor and sign an indemnity declaration.&nbsp;</li>
                    <li>I/we are responsible for any sub-contractor works</li>
                    <li>It &nbsp;is my/our responsibility to ensure all required certification and public liability insurance is in place for any sub-contractors working for me on works relating/found through &nbsp;Fedca.co.uk&nbsp;</li>
                    <li>Any complaints made by a customer will receive a written reply and I/we will contact the customer as soon as possible to resolve any issue.&nbsp;</li>
                    <li>That Fedca.co.uk (Fedca Limited) reserve the right to publish any feedback or reviews on the Fedca.co.uk website relating to any reviews provided by my/our customers relating to any works</li>
                    <li>Fedca.co.uk (Fedca Limited) will not be liable to any trade member for any damages or losses suffered as a result of publication of customer feedback on the Fedca website or elsewhere</li>
                    <li>As a trade member if I/we do not comply with the code of conduct and ethical agreement fedca.co.uk (Fedca Limited) reserve the right to suspend my/our membership&nbsp;</li>
                    <li>Informing my/our customers that their contact details may be shared with Fedca.co.uk (Fedca Limited) to allow feedback to be collected to help other consumers make an informed decision when choosing a trades person or service provider.&nbsp;</li>
                    <li>Fedca.co.uk (Fedca Ltd) Website terms of use, Cookie Policy, Privacy Policy, &amp; subscription terms of sale.&nbsp;</li>
                </ul>


        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}
