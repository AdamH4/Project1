@extends('master')
@section('body')
<div class="container col-4">
    @if(session()->has('wrong_password'))
        <div class="alert alert-danger" id="flash-message">
            @lang('success.wrong_password')
        </div>
    @endif
    @if(session()->has('same_password'))
        <div class="alert alert-danger" id="flash-message">
            @lang('success.same_password')
        </div>
    @endif
    <h4>@lang('message.change_password')</h4>
    <hr>
    <form class="form-group" action="{{route('user.change.password')}}" method="POST">
        {{csrf_field()}}
        <label for="current-password">@lang('message.current_password')</label>
        <input type="password" id="current-password" class="form-control" name="current-password">
        <label for="new-password">@lang('message.new_password')</label>
        <input type="password" id="new-password" class="form-control" name="new-password">
        <label for="password_confirmation">@lang('message.password_confirmation')</label>
        <input type="password" id="password_confirmation" class="form-control" name="new-password_confirmation">
        <br>
        <button class="form-control btn btn-dark" type="submit">@lang('message.change_password')</button>
    </form>
</div>

<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 3000);//milliseconds
</script>
@endsection