@extends('master')

@section('body')


        <form method="post" action="/registration">

            {{ csrf_field() }}

            <label for="name">Name:</label>

            <input type="text" class="form-control" id="name" name="name" required>

            <label for="email">Email:</label>

            <input type="email" class="form-control" id="email" name="email" required>

            <label for="password">Password:</label>

            <input type="password" name="password" id="password" class="form-control" required>

            <label for="password_confirmation">Password Confirmation:</label>

            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>

            <br>

            <button type="submit" name="submit">Register</button>
        </form>

    @include('shop.errors.errors')

@endsection()