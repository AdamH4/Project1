@extends('master')
@section('body')
    <div class="container col-7">
        <h3>All {{$user->name}}'s transactions:</h3>
        <hr>
        @foreach($transactions as $transaction)
            @foreach($transaction as $product)
            <img src="{{ asset('images/'. $product->picture) }}" height="50" width="50">
            <h4>Product name: {{$product->name}}</h4>
            <p>Category: {{$product->category}}</p>
            <p>Quantity: {{$product->quantity}}</p>
            <p>Type: {{$product->payment_type}}</p>
            <p>Transaction ID {{$product->transactionid}}</p>
            @if($product->status == 0)
            <form action="{{route('admin.transaction.complete',$product->transactionid)}}" method="POST">
                {{csrf_field()}}
                <button class="btn btn-success">Odoslana objednavka</button>
            </form>
            @else
            <h4>Transaction posted</h4>
            @endif
            <hr>
            @endforeach
        @endforeach
    </div>
@endsection