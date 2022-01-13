{{ view('templates/header') }}

<section class="text-center">
    <section class="section parallax-container" data-parallax-img="{{ asset('img/stonewrap-parallax.jpg') }}"><div class="material-parallax parallax"><img src="{{ asset('img/stonewrap-parallax.jpg') }}" alt="" style="display: block; transform: translate3d(-50%, 160px, 0px);"></div>
        <div class="parallax-content parallax-header parallax-light">
            <div class="parallax-header__inner">
                <div class="parallax-header__content">
                    <div class="container">
                        <div class="row justify-content-sm-center">
                            <div class="col-md-10 col-xl-8">
                                <h2 class="heading-decorated">Packages</h2>
                                <p class="heading-6">Choose from one of our packages to get started.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<!-- Our Services-->
<section class="section-md bg-default text-center">
    <div class="container">

        {{ view('templates/alert') }}

        <div class="row row-50">

            <?php if(isset($packages) && $packages->count()) : ?>

                <?php foreach($packages as $package) : if(!$package->stripe_id) { continue; } ?>

                    <?php if(isset($package->prices) && $package->prices->count()) : ?>

                        <?php if($package->trial_amount && $package->trial_interval) : ?>
                        <div class="col-md-12">
                            <div class="alert alert-success">
                                <h6>Get {{ $package->trial_amount }} {{ ucfirst($package->trial_interval) }} FREE when you subscribe to one of our packages today.</h6>
                                <small style="font-size: 12px;">You can cancel 14 days prior to your free trial period ending.</small>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php foreach ($package->prices as $price): if(!$price->stripe_id) { continue; } ?>
                        <div class="col-md-6 col-xl-3">
                            <div class="pricing-table-wrap">
                                <div class="pricing-table {{ $price->billing_period == 'Yearly' ? 'pricing-table-label' : '' }}">
                                    <div class="pricing-label"><span>{{ $price->billing_period == 'Yearly' ? 'Save 20%' : '' }}</span>
                                        <svg width="86px" height="86px" viewBox="0 0 86 86">
                                            <path d="M73.4,73.4L67.3,73l-0.8,6.2l-6-1.8l-2.1,5.9l-5.5-3l-3.2,5.3l-4.7-4L40.7,86L37,81.1l-5.1,3.5L29.2,79            l-5.7,2.4l-1.4-6l-6.1,1.1l-0.2-6.2l-6.2-0.2l1.1-6.1l-6-1.4L7,56.8l-5.6-2.7L4.9,49L0,45.3L4.5,41l-4-4.7L5.8,33l-3-5.5l5.9-2.1            l-1.8-6l6.2-0.8l-0.5-6.2l6.2,0.5l0.8-6.2l6,1.8l2.1-5.9l5.5,3l3.2-5.3l4.7,4L45.3,0L49,4.9l5.1-3.5L56.8,7l5.7-2.4l1.4,6l6.1-1.1            l0.2,6.2l6.2,0.2L75.3,22l6,1.4L79,29.2l5.6,2.7L81.1,37l4.9,3.8L81.5,45l4,4.7L80.2,53l3,5.5l-5.9,2.1l1.8,6L73,67.3L73.4,73.4z"></path>
                                        </svg>
                                    </div>
                                    <div class="pricing-header">
                                        <h5>{{ $package->title }}</h5>
                                        {{--<div class="price"><span>£{{ number_format($price->cost) }} </span><span>/{{$price->billing_period}}</span></div>--}}
                                        <?php if($package->trial_amount && $package->trial_interval) : ?>
                                        <div class="price">
                                            <span>FREE </span><span>for {{ $package->trial_amount.' '.ucfirst($package->trial_interval) }}</span>
                                            <br/>then £{{ number_format($price->cost) }} / {{$price->billing_period}}
                                        </div>
                                        <?php else : ?>
                                        <div class="price"><span>£{{ number_format($price->cost) }} </span><span>/{{$price->billing_period}}</span></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="pricing-body">
                                        <ul class="list">
                                            <?php if(isset($package->features) && $package->features->count()) : ?>
                                                <?php foreach ($package->features as $feature) : ?>
                                                    <li>{{ $feature->title }}</li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="pricing-footer"><a class="button button-primary" href="{{ route('subscribe',[$price->id,slug($package->title)])}}">Subscribe</a></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    <?php else : ?>

                    <div class="alert alert-warning">The packages are not fully setup.</div>

                    <?php endif; ?>

                <?php endforeach; ?>

            <?php else : ?>

            <div class="alert alert-warning">Oh wow, there is no packages to display at this time. Please check back later.</div>

            <?php endif; ?>

        </div>
    </div>
</section>


{{ view('templates/footer') }}
