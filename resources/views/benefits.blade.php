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
                    <h5>Typography</h5>
                    <ul class="list-md">
                        <li>
                            <h4>Benefit 1</h4>
                            <p>Been a member of Fedca is cool because you get to pay us.</p>
                        </li>
                        <li>
                            <h4>Benefit 2</h4>
                            <p>Paying us means less money in your pocket.</p>
                        </li>
                        <li>
                            <h4>Benefit 3</h4>
                            <p>Hmmmmmm.</p>
                        </li>

                    </ul>
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
               {{ view('templates.side-menu') }}
            </div>
        </div>
    </div>
</section>


{{ view('templates/footer') }}
