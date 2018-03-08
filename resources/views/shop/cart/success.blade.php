@extends('master')
@section('body')
    <div class="container col-6">
        <h1>Thanks for your payment, we appreciate it!</h1>
        <h3>{{$total}}</h3>
        <form action="{{route('home')}}" method="GET">
            <button type="submit" class="btn btn-dark">OK</button>
        </form>
    </div>
@endsection