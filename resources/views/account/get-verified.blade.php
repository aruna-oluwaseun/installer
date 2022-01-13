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
                <form method="post" action="{{ route('verify.do') }}">
                    @csrf
                    <h4 class="mb-3">Get Verified</h4>

                    <?php if($company->liability && $company->references->count() >= 3) : ?>

                        <div class="alert alert-success">
                            Required information received, we will inform you via email once you are verified.
                        </div>

                    <?php else : ?>

                        <div class="alert alert-info">
                            To become verified we required you to upload your proof of your public liability and give us 3 references for works completed.
                        </div>

                    <?php endif; ?>

                    <?php if($company->liability) : ?>

                    <div class="alert alert-success">
                        We have got your liability document
                    </div>

                    <?php else: ?>

                    <div class="form-group uploadMe" data-type="liability">
                        <label>Company Liability Document</label>
                        <?php if(old('liability.name')) : ?>
                            <span class="text-success font-weight-bold">File already selected {{ old('liability.name') }}</span>
                        <?php endif; ?>
                        <input class="form-input" type="file" value="{{ old('liability.name') }}">

                        <div class="progress-linear mt-2" style="display: none">
                            <div class="progress-header">
                                <p>Upload Progress</p><span class="progress-value">0</span>
                            </div>
                            <div class="progress-bar-linear-wrap">
                                <div class="progress-bar-linear"></div>
                            </div>
                        </div>

                        <div class="file-inputs">
                            <?php if(request()->exists('liability.uuid')) : ?>
                                <input type="hidden" name="liability[uuid]" value="{{ old('liability.uuid') }}">
                            <?php endif; ?>
                            <?php if(request()->exists('liability.key')) : ?>
                                <input type="hidden" name="liability[key]" value="{{ old('liability.key') }}">
                            <?php endif; ?>
                            <?php if(request()->exists('liability.name')) : ?>
                                <input type="hidden" name="liability[name]" value="{{ old('liability.name') }}">
                            <?php endif; ?>
                            <?php if(request()->exists('liability.content_type')) : ?>
                                <input type="hidden" name="liability[content_type]" value="{{ old('liability.content_type') }}">
                            <?php endif; ?>
                        </div>
                        <p class="text-info mt-2">Max image size 5mb</p>
                    </div>
                    <?php endif; ?>

                    <?php if($company->references->count() >= 3) : ?>

                    <div class="alert alert-success">
                        Your references have been uploaded.
                    </div>

                    <?php else : ?>

                    <!-- Reference one -->
                    <div class="card card-bordered mb-3">
                        <div class="card-header">
                            <h6>Reference 1</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3"></h6>

                            <?php if(isset($company->references[0])) : ?>
                                <input type="hidden" name="reference[1][ignore]" value="1">
                            <?php endif; ?>

                            <div class="form-group">
                                <label>Customer full name *</label>
                                <input class="form-input title" type="text" name="reference[1][full_name]" value="{{ old('reference.1.full_name', isset($company->references[0]->full_name) ? $company->references[0]->full_name : '') }}" required>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number *</label>
                                        <input class="form-input" type="tel" name="reference[1][phone]" value="{{ old('reference.1.phone',isset($company->references[0]->phone) ? $company->references[0]->phone : '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input class="form-input" type="email" name="reference[1][email]"  value="{{ old('reference.1.email',isset($company->references[0]->email) ? $company->references[0]->email : '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Works completed</label>
                                <textarea class="form-input" rows="3" name="reference[1][works_completed]" placeholder="Enter a brief description of what you did for this customer">{{ old('reference.1.works_completed',isset($company->references[0]->works_completed) ? $company->references[0]->works_completed : '') }}</textarea>
                                <p class="text-info mt-2">This is optional but recommended as it helps speed to review process up</p>
                            </div>
                        </div>
                    </div> <!-- end one -->

                    <!-- Reference Two -->
                    <div class="card card-bordered mb-3">
                        <div class="card-header">
                            <h6>Reference 2</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3"></h6>

                            <?php if(isset($company->references[1])) : ?>
                            <input type="hidden" name="reference[2][ignore]" value="1">
                            <?php endif; ?>

                            <div class="form-group">
                                <label>Customer full name *</label>
                                <input class="form-input title" type="text" name="reference[2][full_name]" value="{{ old('reference.2.full_name', isset($company->references[1]->full_name) ? $company->references[1]->full_name : '') }}" required>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number *</label>
                                        <input class="form-input" type="tel" name="reference[2][phone]" value="{{ old('reference.2.phone',isset($company->references[1]->phone) ? $company->references[1]->phone : '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input class="form-input" type="email" name="reference[2][email]"  value="{{ old('reference.2.email',isset($company->references[1]->email) ? $company->references[1]->email : '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Works completed</label>
                                <textarea class="form-input" rows="3" name="reference[2][works_completed]" placeholder="Enter a brief description of what you did for this customer">{{ old('reference.2.works_completed',isset($company->references[1]->works_completed) ? $company->references[1]->works_completed : '') }}</textarea>
                                <p class="text-info mt-2">This is optional but recommended as it helps speed to review process up</p>
                            </div>
                        </div>
                    </div> <!-- end two -->

                    <!-- Reference Three -->
                    <div class="card card-bordered mb-3">
                        <div class="card-header">
                            <h6>Reference 3</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3"></h6>

                            <?php if(isset($company->references[2])) : ?>
                                <input type="hidden" name="reference[3][ignore]" value="1">
                            <?php endif; ?>

                            <div class="form-group">
                                <label>Customer full name *</label>
                                <input class="form-input title" type="text" name="reference[3][full_name]" value="{{ old('reference.3.full_name', isset($company->references[2]->full_name) ? $company->references[2]->full_name : '') }}" required>
                            </div>

                            <div class="row mt-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number *</label>
                                        <input class="form-input" type="tel" name="reference[3][phone]" value="{{ old('reference.3.phone',isset($company->references[2]->phone) ? $company->references[2]->phone : '') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email *</label>
                                        <input class="form-input" type="email" name="reference[3][email]"  value="{{ old('reference.3.email',isset($company->references[2]->email) ? $company->references[2]->email : '') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Works completed</label>
                                <textarea class="form-input" rows="3" name="reference[3][works_completed]" placeholder="Enter a brief description of what you did for this customer">{{ old('reference.3.works_completed',isset($company->references[2]->works_completed) ? $company->references[2]->works_completed : '') }}</textarea>
                                <p class="text-info mt-2">This is optional but recommended as it helps speed to review process up</p>
                            </div>
                        </div>
                    </div> <!-- end three -->

                    <?php endif; ?>

                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                </form>
            </div>

            <!-- sidemenu -->
            <div class="col-lg-5 col-xl-4 section-divided__aside section__aside-left">
                {{ view('account.templates.side-menu') }}
            </div>
        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}

<script type="text/javascript">

    $('.uploadMe input[type=file]').on('change',function(e) {

        var ext = $(this).val().split(".");
        ext = ext[ext.length-1].toLowerCase();
        var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif", "pdf"];

        if (arrayExtensions.lastIndexOf(ext) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid file type',
                text: 'Please select a valid image or PDF file only, ' + ext + ' is not supported.',
                //footer: '<a href>Why do I have this issue?</a>'
            });
            $(this).val("");
            return;
        }

        var parent = $(this).parents('.uploadMe');
        var field = parent.data('type');
        var myFile = $(this).prop('files')[0];
        var progress_container = parent.find('.progress-linear');
        var progress_text = parent.find('.progress-value');
        var progress_display = parent.find('.progress-bar-linear');

        // check file size
        if(myFile.size > 5000000)
        {
            Swal.fire({
                icon: 'error',
                title: 'File too big',
                text: 'Your file exceeded our limit of 5mb.',
                //footer: '<a href>Why do I have this issue?</a>'
            });
            $(this).val("");
            return;
        }

        progress_container.show();
        progress_display.removeClass('success');
        progress_text.text(0);
        progress_display.css('width','0%');

        //debug(myFile);
        Vapor.store(myFile, {
            visibility: 'public-read',
            progress: progress => {
                const percentage = Math.round(progress * 100);
                progress_text.text(percentage);
                progress_display.css('width',percentage + '%');
            }
        }).then(response => {

            parent.find('.file-inputs').html(
                '<input type="hidden" name="'+ field +'[uuid]" value="' + response.uuid + '">'+
                '<input type="hidden" name="'+ field +'[key]" value="' + response.key + '">' +
                //'<input type="hidden" name="'+ field +'[bucket]" value="' + response.bucket + '">' +
                '<input type="hidden" name="'+ field +'[name]" value="' + myFile.name + '">' +
                '<input type="hidden" name="'+ field +'[content_type]" value="' + myFile.type + '">'
            );

            progress_display.addClass('success');

            setTimeout(function() {
                progress_container.hide();
            },1000);

            /*axios.post(uploadUrl, {
                uuid: response.uuid,
                key: response.key,
                bucket: response.bucket,
                name: myFile.name,
                content_type: myFile.type,
            })*/

        });
    });
</script>
