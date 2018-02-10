@extends('master')

@section('body')


    <form method="POST" action="/login">

        {{ csrf_field() }}

        <div class="form-group">

            <label for="email">Your E-mail address:</label>

            <input class="form-control" type="email" name="email" id="email">

        </div>

        <div class="form-group">

            <label for="password">Your password:</label>

            <input class="form-control" type="password" name="password" id="password">

            <br>

            <button type="submit" class="btn btn-primary">Sign in</button>


        </div>

    </form>
    <form action="/password/reset" method="GET">
        <button type="submit" class="btn btn-primary">Forgot my password</button>
    </form>

    @include('shop.errors.errors')


@endsection()