{{ view('templates/header') }}

<section class="text-center">
    <section class="section parallax-container" data-parallax-img="{{ asset('img/stonewrap-parallax.jpg') }}"><div class="material-parallax parallax"><img src="{{ asset('img/stonewrap-parallax.jpg') }}" alt="" style="display: block; transform: translate3d(-50%, 160px, 0px);"></div>
        <div class="parallax-content parallax-header parallax-light">
            <div class="parallax-header__inner">
                <div class="parallax-header__content">
                    <div class="container">
                        <div class="row justify-content-sm-center">
                            <div class="col-md-10 col-xl-8">
                                <h2 class="heading-decorated">About</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<!-- Our Services-->
<section class="section-md bg-default">
    <div class="container">
        <div class="row justify-content-md-center row-30 row-md-50">
            <div class="col-md-11 col-lg-10 col-xl-6">
                <h4 class="heading-decorated">Our mission.</h4>
                <p>
                    FEDCA limited was setup with the mission to:
                    <ul class="list-marked">
                        <li>Enable Customers to find quality tradespersons</li>
                        <li>Educate customers</li>
                        <li>Enhance customer protection</li>
                        <li>Assist tradespersons to find work, market themselves & manage their day to day business</li>
                    </ul>

                </p>

                <h4 class="heading-decorated">About.</h4>
                <p>
                    At FEDCA we specialise in finding high quality trade persons who specialise in the decorative coatings industry consisting of:
                    <ul class="list-marked">
                        <li>Decorative Resin Flooring / Metallic Epoxy Resin</li>
                        <li>Polished Concrete</li>
                        <li>Venetian Plaster</li>
                        <li>Micro-cement</li>
                        <li>Stone veneers</li>
                        <li>Resin bound driveways</li>
                        <li>AND MORE</li>
                    </ul>
                    <br>Here you will find information beneficial  for customers to understand the product and/or service they are searching for enhancing their happiness in products &/or installers chosen. By educating customers we can ensure they receive quality & reliable information.

                </p>
            </div>
            <div class="col-md-11 col-lg-10 col-xl-6"><img src="{{ asset('img/Resin-652x491.jpg') }}" alt="" width="652" height="491">
            </div>
        </div>
    </div>
</section>


{{ view('templates/footer') }}
