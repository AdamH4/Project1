@extends('master')

@section('body')


    <form action="/password/email" method="POST">
        <label for="email">Put here your email for password resset</label>
        <input type="email" name="email" placeholder="Your email here">
        <button type="submit" name="submit">Send</button>
    </form>

@endsection