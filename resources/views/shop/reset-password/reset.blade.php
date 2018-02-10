@extends('master')

@section('body')


    <form action="" method="POST">

        {{csrf_field()}}

        <label for="email">Your Email</label>
        <input type="email" name="email" placeholder="Your email here">
        <label for="password">Your new password</label>
        <input type="password" name="password">
        <button type="submit" name="submit">Login</button>
    </form>

@endsection