@push('styles')
    <link rel="stylesheet" href="{{ asset('libraries/password/strengthify.min.css') }}">
@endpush
{{ view('templates/header') }}

<section class="section section-lg bg-default text-center">
    <div class="container">
        <h3 class="heading-decorated">Company Verification</h3>
        <div class="row justify-content-lg-center">

            <div class="col-lg-10 col-xl-8">
            <h2>{{ $company->title }}</h2>

            {{ view('templates/alert') }}

                <?php if(!$company->verified) : ?>

                    <?php if(isset($company->references) && $company->references->count()) : ?>
                        <!-- RD Mailform -->
                        <form class="text-left" method="post" action="{{ url('action-company-verification/'.sha1_me($company->id)) }}" novalidate="novalidate">
                            @csrf
                            @method('PUT')

                            <?php foreach($company->references as $key => $reference) : ?>
                            <h5 class="mb-2">Reference {{ $key+1 }}</h5>
                            <ul class="list-group mb-3">
                                <li class="list-group-item"><strong>Full name :</strong> {{ $reference->full_name }}</li>
                                <li class="list-group-item"><strong>Phone :</strong> {{ $reference->phone }}</li>
                                <li class="list-group-item"><strong>Email :</strong> {{ $reference->email }}</li>
                                <li class="list-group-item"><strong>Works completed :</strong> {{ $reference->works_completed }}</li>
                                <div class="list-group-item">
                                    <a href="{{ url('action-company-verification/delete-reference/'.$reference->id) }}" class="btn btn-danger destroy-btn">Remove reference</a>
                                </div>
                            </ul>

                            <?php endforeach; ?>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Liability :</strong>
                                    <?php if(\Illuminate\Support\Facades\Storage::exists($company->liability)) : ?>
                                        <a class="btn btn-primary" href="{{ \Illuminate\Support\Facades\Storage::url($company->liability) }}" target="_blank">
                                            View Document
                                        </a>
                                    <?php else : ?>
                                        Nothing uploaded
                                    <?php endif; ?>
                                </li>
                            </ul>

                            <?php if($company->references->count() == 3) : ?>
                            <div class="form-wrap">
                                <input type="radio" name="status" value="approved" id="verify-approve" {{ is_checked('approved', old('status')) }}> <label for="action-approve" class="font-weight-bold text-success">Approve</label><br>
                                <input type="radio" name="status" value="declined" id="verify-decline" {{ is_checked('declined', old('status')) }}> <label for="action-decline" class="font-weight-bold text-danger">Decline (for deleting reference)</label><br>
                            </div>
                            <?php else : ?>
                            <div class="form-wrap">
                                <input type="radio" name="status" value="approved" id="verify-approve" disabled> <label for="action-approve" class="font-weight-bold text-success">Approve (Not enough reference to approve)</label><br>
                                <input type="radio" name="status" value="declined" id="verify-decline" checked> <label for="action-decline" class="font-weight-bold text-danger">Decline (If you removed a reference check this the user will be alerted to add a new reference)</label><br>
                            </div>
                            <?php endif; ?>

                            <div class="form-wrap" id="decline-reason" style="display: {{ is_checked('declined', old('status', 'declined')) ? 'block' : 'none' }}">
                                <label>Decline reason *</label>
                                <textarea class="form-input" name="reason">{{ old('reason') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    <?php else : ?>

                        <div class="alert alert-danger">We could not find the references or liability document</div>

                    <?php endif; ?>

                <?php else : ?>

                    <div class="alert alert-success">Company has been verified on {{ short_date_time($company->verified) }}</div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}

<script type="text/javascript">
    $('[name="status"]').on('change',function() {
        if($(this).val() == 'declined')
        {
            $('#decline-reason').show();
        }
        else {
            $('#decline-reason').hide();
        }
    });

    $(document).on('click','.destroy-btn', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var async = $(this).data('async') ? $(this).data('async') : false;
        var self = $(this);

        Swal.fire({
            title: 'Are you sure you want remove this item?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, remove it!'

        }).then(function (action) {
            if( action.isConfirmed ) {
                // send via ajax
                if(async) {
                    $.ajax({
                        method : 'get',
                        url: url,
                        success: function(response) {
                            console.log(response);
                            if(response.success)
                            {
                                if( self.parents('.remove-target').length) {
                                    self.parents('.remove-target').remove();

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Item removed.',
                                        //footer: '<a href>Why do I have this issue?</a>'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Item removed, please re-fresh for the item to removed from your view.',
                                        //footer: '<a href>Why do I have this issue?</a>'
                                    });
                                }
                            }
                            else
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.message ? response.message : 'An error occurred remove this item please re-fresh and try again.',
                                    //footer: '<a href>Why do I have this issue?</a>'
                                });
                            }
                        },
                        error: function(XHR, textStatus, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'An error occurred removing your item, please re-fresh your page and try again.',
                                //footer: '<a href>Why do I have this issue?</a>'
                            });
                        }
                    });

                } else {
                    window.location = url;
                }
            }

        })
    });
</script>
