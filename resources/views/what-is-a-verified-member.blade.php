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
        <div class="row row-50 row-md-75">
            <div class="col-lg-8 section-divided__main">
                <!-- Base typography-->
                <section class="section-sm">
                    <h4>What is a {{ strtoupper(env('APP_NAME')) }} Verified Member?</h4>
                    <p>A {{ strtoupper(env('APP_NAME')) }} verified member is a company or individual who has submitted three job references to {{ strtoupper(env('APP_NAME')) }} along with proof of public liability insurance.</p>
                    <p>By vetting members through the use of references we can help ensure customer find quality tradespersons with a history of a high standard of work. At {{ strtoupper(env('APP_NAME')) }} we also recognise jobs do sometimes go wrong and by ensuring that a tradesperson has public liability insurance this can help correct works if and when they do</p>
                </section>

                <!-- Base typography-->
                <section class="section-sm">
                    <h4>How do I recognise a Verified Member?</h4>
                    <p>A verified member will have a green tick next to their company name <img src="{{ asset('img/icon-verified.png') }}" width="20"> </p>
                </section>

                <section class="section-sm">
                    <h4>How do I become a verified member?</h4>
                    <p>Once you have created an account and subscribed to a package you may submit yourself to become verified by following the verification tab. You will be asked to submit three references for {{ strtoupper(env('APP_NAME')) }} to contact along with your public liability insurance certificate.</p>
                </section>

                <section class="section-sm">
                    <h4>{{ strtoupper(env('APP_NAME')) }} 5 star rating system</h4>
                    <p>At {{ strtoupper(env('APP_NAME')) }} all our members are eligible to receive reviews from customers. In addition {{ strtoupper(env('APP_NAME')) }} monitor all reviews to help limit the risk of fake positive & negative reviews that can be misleading to customers. Customer reviews that have been verified by {{ strtoupper(env('APP_NAME')) }} showcase a green tick next to the review.</p>
                </section>



                <!-- Left aligned image-->
                {{--<section class="section-sm">
                    <h5>Left aligned image</h5>
                    <div class="row flex-md-row-reverse row-30">
                        <div class="col-md-6">
                            <p>Welcome to our wonderful world. We sincerely hope that each and every user entering our website will find exactly what he/she is looking for. With advanced features of activating account and new login widgets, you will definitely have a great experience of using our web page.</p>
                        </div>
                        <div class="col-md-6">
                            <figure class="figure"><img src="images/typography-1-1500x1000.jpg" alt="" width="1500" height="1000">
                            </figure>
                        </div>
                    </div>
                </section>--}}

                <!-- Right aligned image-->
                {{--<section class="section-sm">
                    <h5>Right aligned image</h5>
                    <div class="row row-30">
                        <div class="col-md-6">
                            <p>Welcome to our wonderful world. We sincerely hope that each and every user entering our website will find exactly what he/she is looking for. With advanced features of activating account and new login widgets, you will definitely have a great experience of using our web page.</p>
                        </div>
                        <div class="col-md-6">
                            <figure class="figure"><img src="images/typography-1-1500x1000.jpg" alt="" width="1500" height="1000">
                            </figure>
                        </div>
                    </div>
                </section>--}}

            </div>
            <div class="col-lg-4 section-divided__aside">
               {{--{{ view('templates.side-menu') }}--}}
            </div>
        </div>
    </div>
</section>


{{ view('templates/footer') }}
