@push('styles')
    <link rel="stylesheet" href="{{ asset('libraries/password/strengthify.min.css') }}">
@endpush
{{ view('templates/header') }}

<section class="section section-lg bg-default text-center">
    <div class="container">
        <h3 class="heading-decorated">Companies</h3>
        <div class="row justify-content-lg-center">

            <div class="col-lg-10 col-xl-8">

            {{ view('templates/alert') }}

                <!-- RD Mailform -->
                <form class="text-left" method="post" action="" novalidate="novalidate">
                    @csrf

                    <div class="form-wrap" id="decline-reason" style="display: {{ is_checked('declined', old('status', '1') ? 'block' : 'none') }}">
                        <label>Enter passcode </label>
                        <input class="form-input" name="code">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Access list</button>
                </form>

                <?php if($companies !== false ) : ?>

                <table class="table table-bordered mt-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Phone</th>
                            <th>Owner Email</th>
                            <th>Action needed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($companies as $company) : ?>
                        <?php
                            $plan = $company->user->subscriptions()->first();

                            $action = [];
                            if(!$plan) {
                                $action[] = 'Subscription needed';
                            }

                            if(!$company->services->count()) {
                                $action[] = 'Service needs linking';
                            }

                            if(!$company->address_data) {
                                $action[] = 'Address needed for searching';
                            }
                        ?>
                        <tr>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->title }}</td>
                            <td>{{ $company->user->getFullNameAttribute() }}</td>
                            <td class="bg-{{ $company->status == 'active' ? 'success' : 'warning'}}">
                                {{ $company->status == 'active' ? 'Subscribed or manually approved' : 'No subscription' }}
                            </td>
                            <td>{{ $company->user->contact_number }}</td>
                            <td>{{ $company->user->email }}</td>
                            <td>
                                <?php if(empty($action)) : ?>
                                    <span class="text-success">No action required</span>
                                <?php else : ?>
                                    <span class="text-danger">
                                        {{ implode(' | ', $action) }}
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?php else : ?>

                <div class="alert alert-danger">Passcode needed to access this area</div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

@push('scripts')

@endpush
{{ view('templates/footer') }}

<script type="text/javascript">

</script>
