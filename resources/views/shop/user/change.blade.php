@extends('master')
@section('body')
    <div class="container col-4">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session()->get('error')}}
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
            <button type="submit" class="btn btn-dark">@lang('message.change_password')</button>
        </form>
    </div>
@endsection