@extends('master')

@section('body')
<div class="container col-4 form-group">
    <h2>@lang('message.reset_password')</h2>
    <hr>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="email">@lang('message.e-mail')</label>
        <input id="email" type="email" class="form-control" name="email" value="">
        <label for="password" class="control-label">@lang('message.new_password')</label>
        <input id="password" type="password" class="form-control" name="password" required>
        <label for="password-confirm" class="control-label">@lang('message.password_confirmation')</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        <br>
        <button type="submit" class="btn btn-dark form-control">@lang('message.reset')</button>
        </div>
    </form>
</div>
@endsection