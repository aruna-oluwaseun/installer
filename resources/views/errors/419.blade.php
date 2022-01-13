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
                                <h2 class="heading-decorated">Not Found</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section>

<section class="section section-lg bg-default">
    <div class="container">

        {{ view('templates/alert') }}

        <div class="row row-70">

            <div class="col-md-12">
                <h3>Link expired</h3>
                <p>Please refresh or go back as the link has now expired, links expire for security reasons.</p>
                <a href="{{ back()->getTargetUrl() }}" class="btn btn-primary">Go Back</a>

            </div>

        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}

<script type="text/javascript">

</script>
