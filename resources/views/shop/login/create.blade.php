@extends('master')
@section('body')
<div class="container col-4" id="login-form">
@if(session()->has('unsuccess_message'))
    <div class="alert alert-danger" id="flash-message">
        @lang('errors.login_crash')
    </div>
@endif
<h3>@lang('message.sign_in')</h3>
<hr>
<form method="POST" action="{{ route('login.create') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="email">@lang('message.e-mail'):</label>
        <input class="form-control" type="email" name="email" id="email" value="{{old('mame')}}" required>
    </div>
    <div class="form-group">
        <label for="password">@lang('message.password'):</label>
        <input class="form-control" type="password" name="password" id="password" required>
        <br>
        <button type="submit" class="btn btn-dark form-control">@lang('message.sign_in')</button>
    </div>
</form>
<form action="{{ route('password.request') }}" method="GET">
    <button type="submit" class="btn btn-dark form-control">@lang('message.forgot_password')</button>
</form>
<form action="{{ route('registration.index') }}" method="GET">
    <button type="submit" class="btn btn-dark form-control">@lang('message.register')</button>
</form>
@include('shop.errors.error')
</div>

<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 3000); // milliseconds
</script>
@endsection()