<!-- Categories-->
<section class="section-sm">
    <h6>Account</h6>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link {{ is_active_menu('company/profile') ? 'active' : '' }}" href="{{ url('company/profile') }}" >Company Profile</a>
        <a class="nav-link {{ is_active_menu('account') ? 'active' : '' }}" href="{{ url('account') }}">Account Details</a>
        <a class="nav-link {{ is_active_menu('account/payment') ? 'active' : '' }}" href="{{ url('account/payment-method') }}">Payment Method</a>
        <a class="nav-link {{ is_active_menu('account/package') ? 'active' : '' }}" href="{{ url('account/package') }}">Package</a>
        <?php if(!get_company()->verified) : ?>
        <a class="nav-link {{ is_active_menu('account/verify-me') ? 'active' : '' }}" href="{{ url('company/get-verified') }}">Get Verified</a>
        <?php endif; ?>
        {{--<a class="nav-link {{ is_active_menu('account/settings') ? 'active' : '' }}" href="{{ url('account/settings') }}">Settings</a>--}}
        {{--<a class="nav-link {{ is_active_menu('account/notifications') ? 'active' : '' }}" href="{{ url('account/notifications') }}">Notifications</a>--}}
    </div>
</section>
