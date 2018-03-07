@extends('master')
@section('body')
    <h3>All {{$user->name}}'s transactions:</h3>
    <hr>
    @foreach($transactions as $product)
        <img src="{{ asset('images/'. $product->picture) }}" height="50" width="50">
        <h4>Product name: {{$product->name}}</h4>
        <p>Category: {{$product->category}}</p>
        <p>Quantity: {{$product->quantity}}</p>
        <p>Transaction ID {{$product->transactionid}}</p>
        <hr>
    @endforeach
@endsection