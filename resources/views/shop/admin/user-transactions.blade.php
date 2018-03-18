@extends('master')
@section('body')
    <div class="container col-9">
        <form action="{{route('admin.users')}}" method="GET">
            <button class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i></button>
        </form>
        <h3>All {{$user->name}}'s transactions</h3>
        <h5>Uncompleted transactions: {{$completed->count()}}</h5>
        <hr>
        @foreach($transactions as $transaction)
            <div class="row">
                @foreach($transaction as $product)
                <div class="col-3">
                    <img src="{{ asset('images/'. $product->picture) }}" height="50" width="50">
                    <h4>Product name: {{$product->name}}</h4>
                    <p>Category: {{$product->category}}</p>
                    <p>Quantity: {{$product->quantity}}</p>
                    <p>Type: {{$product->payment_type}}</p>
                    <p>Delivery type: {{$product->delivery_type}}</p>
                    <p>Transaction ID {{$product->transactionid}}</p>
                    <p>Note: {{$product->note}}</p>
                </div>
                @endforeach
            </div>
                @if($product->status == 0)
                    <form action="{{route('admin.transaction.complete',$product->transactionid)}}" method="POST">
                        {{csrf_field()}}
                        <button class="btn btn-dark">Odoslana objednavka</button>
                    </form>
                @else
                    <h4>Transaction posted</h4>
                @endif
            <hr>
        @endforeach
    </div>
@endsection