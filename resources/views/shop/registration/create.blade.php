@extends('master')
@section('body')
<div class="container col-6 offset-3" id="registration-form">
    @include('shop.errors.error')
    @if(session()->has('no_recaptcha'))
        <div class="alert alert-danger" id="flash-message">
            @lang('errors.no_recaptcha')
        </div>
    @endif
    <h3>@lang('message.register')</h3>
    <hr>
    <form method="post" action="{{ route('registration.store') }}">
        {{ csrf_field() }}
        <label for="name">@lang('message.name'):</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
        <label for="email">@lang('message.e-mail'):</label>
        <input type="email" class="form-control" id="email" name="email" required value="{{old('email')}}">
        <label for="password">@lang('message.password'):</label>
        <input type="password" name="password" id="password" class="form-control" required>
        <label for="password_confirmation">@lang('message.password_confirmation'):</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        <br>
        <div class="g-recaptcha" data-sitekey="6LcFekYUAAAAANeBHkA4ardK8unmIpIV69RMbRuW"></div>
        <br>
        <label for="check"><a href="#">@lang('message.licence')</a></label>
        <input type="checkbox" name="check" id="check">
        <br>
        <button class="btn btn-dark form-control" type="submit" name="submit">@lang('message.registration')</button>
    </form>
</div>
@endsection()