@if (session('warning'))
    {!! Helper::warningAlert(session('warning')) !!}
@endif

@if (session('success'))
    {!! Helper::successAlert(session('success')) !!}
@endif

@if (session('error'))
    {!! Helper::errorAlert(session('error')) !!}
@endif