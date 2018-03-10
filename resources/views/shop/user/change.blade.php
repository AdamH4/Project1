@extends('master')
@section('body')
    <div class="container col-4">
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session()->get('error')}}
            </div>
        @endif
        <h4>Change password</h4>
        <hr>
        <form class="form-group" action="{{route('user.change.password')}}" method="POST">
            {{csrf_field()}}
            <label for="current-password">Current password</label>
            <input type="password" id="current-password" class="form-control" name="current-password">
            <label for="new-password">New password</label>
            <input type="password" id="new-password" class="form-control" name="new-password">
            <label for="password_confirmation">Confirm new password</label>
            <input type="password" id="password_confirmation" class="form-control" name="new-password_confirmation">
            <br>
            <button type="submit" class="btn btn-dark">Change password</button>
        </form>
    </div>
@endsection