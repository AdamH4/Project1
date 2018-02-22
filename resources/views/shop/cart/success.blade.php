@extends('master')
@section('body')
    <h1>
        Thanks for your payment, we appreciate it!
    </h1>
    <h3>
        You payed {{$total}}
    </h3>
    <form action="{{route('home')}}" method="GET">
        <button type="submit" class="btn-outline-primary">OK</button>
    </form>
@endsection