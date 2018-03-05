@extends('master')
@section('body')
    @foreach($transactions as $transaction)
        <img src="{{ asset('images/'. $transaction->picture) }}" height="100" width="100">
        <h4>{{$transaction->name}}</h4>
        <p>{{$transaction->category}}</p>
        <p>{{$transaction->quantity}}</p>
        <p>{{$transaction->price * $transaction->quantity}}</p>
    @endforeach
    <h5>{{$total}}</h5>
@endsection