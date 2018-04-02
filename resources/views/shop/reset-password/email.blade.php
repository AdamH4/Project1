@extends('master')
@section('body')
<div class="container col-6 offset-3 form-group">
    @if(session()->has('status'))
        <div class="alert alert-success" id="flash-message">
            @lang('success.password_reset')
        </div>
    @endif
    <h2>@lang('message.reset_link')</h2>
    <hr>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <label for="email">@lang('message.e-mail')</label>
        <input id="email" class="form-control" name="email" value="{{old('email')}}" required>
        <br>
        <button class="btn btn-dark form-control" type="submit">@lang('message.send_link')</button>
    </form>
</div>
<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 3000); // <-- time in milliseconds
</script>
@endsection