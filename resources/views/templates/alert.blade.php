@if(session('success'))
    <div class=" mb-3">
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    </div>
@endif
@if(session('error'))
    <div class=" mb-3">
        <div class="alert alert-danger">
            {!! session('error') !!}
        </div>
    </div>
@endif
@if(session('warning'))
    <div class=" mb-3" >
        <div class="alert alert-warning">
            {!! session('warning') !!}
        </div>
    </div>
@endif
@if(session('info'))
    <div class=" mb-3">
        <div class="alert alert-info">
            {!! session('info') !!}
        </div>
    </div>
@endif

@isset($errors)
@if ($errors->any())
    <div class=" mb-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@endisset
