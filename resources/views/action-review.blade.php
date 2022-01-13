@push('styles')
    <link rel="stylesheet" href="{{ asset('libraries/password/strengthify.min.css') }}">
@endpush
{{ view('templates/header') }}

<section class="section section-lg bg-default text-center">
    <div class="container">
        <h3 class="heading-decorated">Action Review</h3>
        <div class="row justify-content-lg-center">

            <div class="col-lg-10 col-xl-8">

            {{ view('templates/alert') }}

                <!-- RD Mailform -->
                <form class="text-left" method="post" action="{{ url('action-review/'.sha1_me($review->id)) }}" novalidate="novalidate">
                    @csrf
                    @method('PUT')

                    <ul class="list-group">
                        <li class="list-group-item"><strong>Review for :</strong> {{ $review->company->title }}</li>
                        <li class="list-group-item"><strong>Reviewer :</strong> {{ $review->first_name.' '.$review->last_name }}</li>
                        <li class="list-group-item"><strong>Email :</strong> {{ $review->email }}</li>
                        <li class="list-group-item"><strong>Review Title :</strong> {{ $review->title }}</li>
                        <li class="list-group-item">
                            <?php
                            $rating = round($review->rating*2) / 2;
                            ?>
                            <fieldset class="rate small">
                                <input type="radio" id="first-rating10" value="10" disabled {{ is_checked(10, ($rating*2)) }} /><label for="first-rating10" title="5 stars"></label>
                                <input type="radio" id="first-rating9" value="9" disabled {{ is_checked(9, ($rating*2)) }} /><label class="half" for="first-rating9" title="4 1/2 stars"></label>
                                <input type="radio" id="first-rating8" value="8" disabled {{ is_checked(8, ($rating*2)) }} /><label for="first-rating8" title="4 stars"></label>
                                <input type="radio" id="first-rating7" value="7" disabled {{ is_checked(7, ($rating*2)) }} /><label class="half" for="first-rating7" title="3 1/2 stars"></label>
                                <input type="radio" id="first-rating6" value="6" disabled {{ is_checked(6, ($rating*2)) }} /><label for="first-rating6" title="3 stars"></label>
                                <input type="radio" id="first-rating5" value="5" disabled {{ is_checked(5, ($rating*2)) }} /><label class="half" for="first-rating5" title="2 1/2 stars"></label>
                                <input type="radio" id="first-rating4" value="4" disabled {{ is_checked(4, ($rating*2)) }} /><label for="first-rating4" title="2 stars"></label>
                                <input type="radio" id="first-rating3" value="3" disabled {{ is_checked(3, ($rating*2)) }} /><label class="half" for="first-rating3" title="1 1/2 stars"></label>
                                <input type="radio" id="first-rating2" value="2" disabled {{ is_checked(2, ($rating*2)) }} /><label for="first-rating2" title="1 star"></label>
                                <input type="radio" id="first-rating1" value="1" disabled {{ is_checked(1, ($rating*2)) }} /><label class="half" for="first-rating1" title="1/2 star"></label>
                            </fieldset>
                        </li>
                        <li class="list-group-item"><strong>Review :</strong> {{ $review->description }}</li>
                        <li class="list-group-item"><strong>Proof of works :</strong>
                            <?php if(\Illuminate\Support\Facades\Storage::exists($review->proof)) : ?>
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($review->proof) }}" target="_blank">
                                    <img width="200" src="{{ \Illuminate\Support\Facades\Storage::url($review->proof) }}">
                                </a>
                            <?php else : ?>
                                Nothing uploaded
                            <?php endif; ?>
                        </li>
                    </ul>

                    <div class="form-wrap alert alert-info">
                        <label>Verify review (Only do this if the user has provided proof of works)</label><br>
                        <input type="checkbox" name="verified" value="1"  {{ is_checked('1', old('verified')) }}>
                    </div>

                    <div class="form-wrap">
                        <input type="radio" name="status" value="approved" id="action-approve" {{ is_checked('approved', old('status')) }}> <label for="action-approve" class="font-weight-bold text-success">Approve</label><br>
                        <input type="radio" name="status" value="approve-pending" id="action-approve-pending" {{ is_checked('approve-pending', old('status')) }}> <label for="action-approve-pending" class="font-weight-bold text-warning">Approve - Pending Company Action</label><br>
                        <input type="radio" name="status" value="declined" id="action-decline" {{ is_checked('declined', old('status')) }}> <label for="action-decline" class="font-weight-bold text-danger">Decline</label><br>
                    </div>

                    <div class="form-wrap" id="decline-reason" style="display: {{ is_checked('declined', old('status', '1') ? 'block' : 'none') }}">
                        <label>Decline reason *</label>
                        <textarea class="form-input" name="decline_reason">{{ old('decline_reason') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script src="{{ asset('libraries/password/jquery.strengthify.min.js') }}"></script>
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
</script>
